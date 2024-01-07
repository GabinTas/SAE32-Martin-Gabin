from django.db import models
from home.models import clients

class produits(models.Model):
    name=models.CharField(max_length=150)
    price=models.DecimalField(max_digits=99999,decimal_places=2)
    image=models.ImageField(upload_to="images", default=True)
    class Meta:
        verbose_name=("Product")
        verbose_name_plural=("Products")
    def __str__(self):
        return self.name
    expéditeur = models.ManyToManyField(clients, related_name='expéditeur')
    destinataire = models.ManyToManyField(clients, related_name='destinataire', blank=True)
    transporteur = models.ManyToManyField(clients, related_name='transporteur')
    latitude = models.CharField(max_length=100, blank=True, null=True)
    longitude = models.CharField(max_length=100, blank=True, null=True)
    emballé=models.DateField(auto_now_add=True)
    arrivée_dépôt=models.DateField(null=True, blank=True)
    départ_dépôt=models.DateField(null=True, blank=True)
    date_livraison=models.DateField(null=True, blank=True)
    reçu_le=models.DateField(null=True, blank=True)