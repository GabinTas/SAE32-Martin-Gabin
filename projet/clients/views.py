from django.shortcuts import render
from django.http import HttpResponse

def home(request, *args, **kwargs) :
    return render(request, 'SAE32-AppliCom.html')

def login(request, *args, **kwargs) :
    return render(request, 'Login.html')

def inscription(request, *args, **kwargs) :
    return render(request, 'inscription.html')