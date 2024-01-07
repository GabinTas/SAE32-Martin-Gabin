from django.db import models
from django.contrib.auth.models import User


# Create your models here.

class clients(models.Model):
    account = models.OneToOneField(User, on_delete=models.CASCADE, default=True)
    email = models.EmailField(null=True, blank=True)
    adresse = models.CharField(max_length=100)
    def __str__(self):
        return self.account.username