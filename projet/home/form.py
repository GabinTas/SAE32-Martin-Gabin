from django import forms
from .models import clients

class LoginForm(forms.ModelForm):
    class Meta:
        model = clients
        fields = ['username', 'password']
        widgets = {
            'password': forms.PasswordInput(),
        }