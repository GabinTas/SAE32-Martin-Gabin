# Generated by Django 3.2.12 on 2024-01-07 13:35

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('produits', '0003_auto_20240107_1329'),
    ]

    operations = [
        migrations.AlterField(
            model_name='produits',
            name='latitude',
            field=models.DecimalField(blank=True, decimal_places=100, max_digits=100, null=True),
        ),
        migrations.AlterField(
            model_name='produits',
            name='longitude',
            field=models.DecimalField(blank=True, decimal_places=100, max_digits=100, null=True),
        ),
    ]
