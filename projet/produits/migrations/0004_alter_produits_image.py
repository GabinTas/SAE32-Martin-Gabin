# Generated by Django 3.2.12 on 2023-12-05 07:59

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('produits', '0003_produits_image'),
    ]

    operations = [
        migrations.AlterField(
            model_name='produits',
            name='image',
            field=models.ImageField(default=True, upload_to='images'),
        ),
    ]