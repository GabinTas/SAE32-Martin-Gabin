from django.contrib.auth.forms import AuthenticationForm, UserCreationForm
from django.contrib.auth import authenticate, login, logout
from django.contrib import messages
from django.utils import timezone
from django.shortcuts import render, redirect, get_object_or_404
from django.contrib.auth.hashers import make_password
from django.contrib.auth.models import User, Group
from .models import clients
from django.conf import settings
from .decorators import group_required
import decimal
import sys
from pathlib import Path
from datetime import timedelta

chemin_parent = Path (__file__).resolve().parent.parent
sys.path.append(str(chemin_parent))

from produits.models import produits

def login_user(request):
    if request.user.is_authenticated:
        logout(request)
        form = AuthenticationForm()
        return render(request,'login.html', {"form":form})
    else:
        if request.method == 'POST':
            action = request.POST.get('action')
            if action == 'connexion':
                username = request.POST['username']
                password = request.POST['password']
                user = authenticate(request, username=username, password=password)
                if user is not None:
                    login(request, user)
                    return redirect('home:home')
                else:
                    messages.error(request, "Identifiant ou mot de passe incorrect")
            elif action == 'inscription':
                username = request.POST['username']
                email = request.POST['email']
                password = request.POST['password']
                adresse = request.POST['adresse']
                cp = request.POST['cp']
                if not User.objects.filter(username=username).exists():
                    user = User.objects.create(
                        username=username,
                        email=email,
                        password=make_password(password)
                    )
                    profile = clients.objects.create(
                        account=user,
                        email=email,
                        adresse=adresse
                    )
                    checkbox_cochée = 'transporteur' in request.POST
                    print(checkbox_cochée)
                    if checkbox_cochée:
                        group, created = Group.objects.get_or_create(name="Transporteur")
                    else:
                        group, created = Group.objects.get_or_create(name="Client")
                    user.groups.add(group)
                    messages.success(request, "Utilisateur créé avec succès.")
                    return redirect('home:login')
                else:
                    messages.error(request, "Un utilisateur avec ce nom d'utilisateur existe déjà.")

    form = AuthenticationForm()
    return render(request, "login.html", {"form":form})

def home(request):
    return render(request, "index.html")

@group_required(['Transporteur'])
def transporteur(request):
    if request.method == 'POST':
        produit_id = request.POST.get('produit_id')
        if produit_id:
            produit = get_object_or_404(produits, pk=produit_id)
            date=timezone.now()
            produit.départ_dépôt = date
            produit.date_livraison = date + timedelta(days=1)
            produit.save()
            messages.success(request, "Date de départ du dépôt mise à jour.")
        maj_produits = request.POST.get('maj_produits')
        latitude = request.POST.get('latitude')
        longitude = request.POST.get('longitude')
        for key in request.POST:
            if key.startswith('maj_produits'):
                produit_id = request.POST[key]
                produit = get_object_or_404(produits, pk=produit_id)
                produit.latitude=latitude
                produit.longitude=longitude
                produit.save()
            messages.success(request, "Date de départ du dépôt mise à jour.")
        return redirect('home:transporteur')
    product_object = produits.objects.all()
    return render(request, "transporteur.html", {'product_object':product_object})

@group_required(['Client'])
def ajout(request):
    if request.method == 'POST':
        nom = request.POST['nom']
        prix = request.POST['prix']
        image = request.FILES.get('image')
        latitude = request.POST.get('latitude')
        longitude = request.POST.get('longitude')
        email_destinataire = request.POST.get('email_destinataire')
        transporteur = request.POST.get('transporteur')

        produit = produits.objects.create(
            name=nom,
            price=prix,
            image=image,
            latitude=latitude,
            longitude=longitude
        )
        expediteur, created = clients.objects.get_or_create(account=request.user)
        produit.expéditeur.add(expediteur)

        destinataire = clients.objects.filter(email=email_destinataire).first()
        if destinataire:
            produit.destinataire.add(destinataire)

        transporteur = User.objects.filter(id=transporteur).first()
        if transporteur:
            transporteur, created = clients.objects.get_or_create(account=transporteur)
            produit.transporteur.add(transporteur)

        produit.save()
        messages.success(request, "Produit ajouté avec succès")
        return redirect('home:home')
    
    transporteur_group = Group.objects.get(name='Transporteur')
    transporteurs = transporteur_group.user_set.all()

    context = {
        'transporteurs': transporteurs,
    }

    return render(request, 'ajout.html', context)

@group_required(['Admin'])
def gestion(request):
    if request.method == 'POST':
        produit_id = request.POST.get('produit_id')
        print(produit_id)
        if produit_id:
            produit = get_object_or_404(produits, pk=produit_id)
            produit.arrivée_dépôt = timezone.now()
            produit.latitude = 43.338817198182504
            produit.longitude = 3.2101374864578247
            produit.save()
            messages.success(request, "Date d'arrivée au dépôt mise à jour.")
            return redirect('home:gestion')
        client_id = request.POST.get('client_id')
        try:
            user = get_object_or_404(clients, pk=client_id)

            # Vérifiez les permissions avant toute mise à jour
            if not (request.user.has_perm('auth.change_user') or request.user == user):
                messages.error(request, "Vous n'avez pas la permission de modifier cet utilisateur.")
                return redirect('home:gestion')

            # Récupérez le nouvel email et le nouveau groupe ID du formulaire
            new_email = request.POST.get('email')
            new_group_id = request.POST.get('group')

            if new_email:
                user.email = new_email
            
            user.save()

            if new_group_id:
                client = get_object_or_404(clients, pk=client_id)
                user = client.account  # Accédez au modèle User associé
                new_group = get_object_or_404(Group, pk=new_group_id)
                user.groups.clear()  # Retirez l'utilisateur de tous les groupes existants
                user.groups.add(new_group)  # Ajoutez l'utilisateur au nouveau groupe

            user.save()  
            messages.success(request, "Les informations de l'utilisateur ont été mises à jour avec succès.")
            return redirect('home:gestion')
        except ValueError:
            messages.error(request, "ID client invalide.")
            return redirect('home:gestion')




    product_object = produits.objects.all()
    all_groups = Group.objects.all()
    search_query = request.GET.get('search', '')
    if search_query:
        client_object = clients.objects.filter(email__icontains=search_query)
    else:
        client_object = clients.objects.all()[:10]

    return render(request, 'gestion.html', {'client_object': client_object, 'product_object':product_object, 'all_groups':all_groups})

@group_required(['Client'])
def suivi(request):
    if request.method == 'POST':
        produit_id = request.POST.get('produit_id')
        if produit_id:
            produit = get_object_or_404(produits, pk=produit_id)
            date=timezone.now()
            produit.reçu_le = date
            produit.save()
            messages.success(request, "Colis reçu")
        return redirect('home:suivi')
    product_object = produits.objects.all()
    return render(request, 'suivi.html', {'product_object':product_object})