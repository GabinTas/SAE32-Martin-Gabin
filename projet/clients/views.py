from django.shortcuts import render
from django.http import HttpResponse

def home(request):
    return HttpResponse("<h1 style='font-size:75px;'>Bonjour Gabinou</h1>")