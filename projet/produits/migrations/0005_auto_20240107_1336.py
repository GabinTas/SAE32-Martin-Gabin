# Generated by Django 3.2.12 on 2024-01-07 13:36

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('produits', '0004_auto_20240107_1335'),
    ]

    operations = [
        migrations.AlterField(
            model_name='produits',
            name='latitude',
            field=models.FloatField(blank=True, null=True),
        ),
        migrations.AlterField(
            model_name='produits',
            name='longitude',
            field=models.FloatField(blank=True, null=True),
        ),
    ]
