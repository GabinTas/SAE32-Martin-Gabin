# Generated by Django 3.2.12 on 2023-12-20 19:59

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('home', '0006_rename_email_clients_username'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='clients',
            name='username',
        ),
        migrations.AddField(
            model_name='clients',
            name='email',
            field=models.EmailField(default=True, max_length=100),
        ),
    ]
