from django.contrib import admin
from .models import clients
from django.contrib.auth.admin import UserAdmin
from django.contrib.auth.models import User

# Register your models here.


class clientsInline(admin.StackedInline):
    model = clients
    can_delete=False

class clientsAdmin(UserAdmin):
    inlines = (clientsInline, )

admin.site.unregister(User)
admin.site.register(User, clientsAdmin)