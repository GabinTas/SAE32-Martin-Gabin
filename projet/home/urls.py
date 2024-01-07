from django.urls import path
from .views import login_user, home, profil, panier, ajout, gestion, suivi
from django.conf.urls.static import static
from django.conf import settings

app_name='home'

urlpatterns = [
    path('', home, name='home'),
    path('login/', login_user, name='login'),
    path('profil/', profil, name='profil'),
    path('panier/', panier, name='panier'),
    path('ajout/', ajout, name='ajout'),
    path('gestion/', gestion, name='gestion'),
    path('suivi/', suivi, name='suivi')
]+ static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)