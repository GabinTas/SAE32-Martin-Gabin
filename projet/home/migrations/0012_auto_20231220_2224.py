# Generated by Django 3.2.12 on 2023-12-20 22:24

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        migrations.swappable_dependency(settings.AUTH_USER_MODEL),
        ('home', '0011_auto_20231220_2144'),
    ]

    operations = [
        migrations.AlterModelOptions(
            name='clients',
            options={},
        ),
        migrations.RemoveField(
            model_name='clients',
            name='password',
        ),
        migrations.AddField(
            model_name='clients',
            name='account',
            field=models.OneToOneField(default=True, on_delete=django.db.models.deletion.CASCADE, to=settings.AUTH_USER_MODEL),
        ),
        migrations.AlterField(
            model_name='clients',
            name='email',
            field=models.CharField(max_length=100),
        ),
    ]
