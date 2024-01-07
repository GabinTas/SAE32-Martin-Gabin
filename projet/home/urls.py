from django.urls import path
from .views import login_user, home, ajout, gestion, suivi, transporteur
from django.conf.urls.static import static
from django.conf import settings

app_name='home'

urlpatterns = [
    path('', home, name='home'),
    path('login/', login_user, name='login'),
    path('ajout/', ajout, name='ajout'),
    path('gestion/', gestion, name='gestion'),
    path('suivi/', suivi, name='suivi'),
    path('transporteur/', transporteur, name='transporteur')
]+ static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)