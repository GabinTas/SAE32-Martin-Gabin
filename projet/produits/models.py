from django.db import models

class produits(models.Model):
    name=models.CharField(max_length=150)
    price=models.DecimalField(max_digits=99999,decimal_places=2)
    image=models.ImageField(upload_to="images")
    class Meta:
        verbose_name=("Product")
        verbose_name_plural=("Products")
    def __str__(self):
        return self.name