# Generated by Django 3.2.12 on 2023-12-20 19:03

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('home', '0005_auto_20231218_0002'),
    ]

    operations = [
        migrations.RenameField(
            model_name='clients',
            old_name='email',
            new_name='username',
        ),
    ]
