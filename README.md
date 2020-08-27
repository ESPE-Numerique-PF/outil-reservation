# Outil de réservation

## Initialisation du projet

### Base de données

- Créer une base de données `outil-reservation`
- Créer un utilisateur `outil-reservation` avec tous les droits sur la base de données précédente

### Installation du projet

Dans le dossier racine du serveur Web:

```
git clone https://github.com/ESPE-Numerique-PF/outil-reservation.git
cd ./outil-reservation
php artisan key:generate
composer install
npm install
npm run dev
php artisan storage:link
```

### Configuration du projet

Initialiser les configurations du projet dans les fichiers suivants:
- `config/app.php`
- `config/database.php`
- `.env`

Puis initialiser la base de données:
```
php artisan migrate
```

### En production

Exécutez les commandes suivantes dans le répertoire du projet:

```
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
```

Assurez-vous que qu'Apache ait des accès en écriture dans le projet:

```
sudo chgrp -R www-data <chemin/vers/le/projet>
```

Assurez-vous qu'un alias redirige vers le répertoire public du projet.

## README Laravel

Lien vers le README de Laravel: [README](README_Laravel.md)