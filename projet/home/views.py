from django.contrib.auth.forms import AuthenticationForm, UserCreationForm
from django.contrib.auth import authenticate, login, logout
from django.contrib import messages
from django.shortcuts import render, redirect
from django.contrib.auth.hashers import make_password
from django.contrib.auth.models import User
from .models import clients
from django.core.mail import send_mail
from django.conf import settings

import sys
from pathlib import Path

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
                    checkbox_cochée = 'ma_checkbox' in request.POST
                    if checkbox_cochée:
                        subject = 'Demande de transporteur'
                        message = 'Vous avez reçu une demande de transporteur !'
                        email_from = adresse
                        recipient_list = ['tardieumartinpro@gmail.com',]

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
                    messages.success(request, "Utilisateur créé avec succès.")
                    return redirect('home:login')
                else:
                    messages.error(request, "Un utilisateur avec ce nom d'utilisateur existe déjà.")

    form = AuthenticationForm()
    return render(request, "login.html", {"form":form})

def home(request):
    product_object = produits.objects.all()
    return render(request, "index.html", {'product_object':product_object})

def profil(request):
    return render(request, 'profil.html')

def panier(request):
    return render(request, 'panier.html')

def ajout(request): 
    if request.method == 'POST':
        nom = request.POST['nom']
        prix = request.POST['prix']
        image = request.FILES.get('image')
        print(image)

        produit = produits.objects.create(
            name=nom,
            price=prix,
            image=image
        )
        produit.save()
        messages.success(request, "Produit ajouté avec succès")
        return redirect('home:home')
    return render(request, 'ajout.html')