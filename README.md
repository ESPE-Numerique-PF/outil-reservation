# Outil de réservation

## Configuration recommandée

Sur le serveur hébergeant l'outil:
- PHP 7.3
- MariaDB 10

Pour le développement:
- Laravel 7
- VueJS 2.5

> :warning: **Une mise à niveau des outils peuvent conduire à des anomalies:** les versions plus récentes des outils (notamment Laravel et VueJS)
ont rendu certaines fonctonnalités obsolètes. Veillez à vérifier qu'une mise à jour des outils garantit le bon fonctionnement de l'application,
ou effectuez les changements nécessaires dans le code.

Voir [Risque des problème de compatibilités](doc/upgrade_risk.md).

## Initialisation du projet (en développement)

### Base de données

- Créer une base de données `outil-reservation`
- Créer un utilisateur `outil-reservation` avec tous les droits sur la base de données précédente

### Installation du projet

Dans le dossier racine du serveur Web:

```
git clone https://github.com/ESPE-Numerique-PF/outil-reservation.git
cd ./outil-reservation
composer install
npm install
npm run dev
php artisan key:generate
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

## Travail en développement

Les commandes à utiliser régulièrement en développement concernent:
- les *commandes artisan* (du style `php artisan *commande*`) pour créer des classes (contrôleurs, providers, modèles, ...),
exécuter des migrations (`php artisan migrate`), nettoyer le cache (`php artisan cache:clear` et `php artisan config:clear`) : voir le site de Laravel pour plus de détails
- les commandes `npm` pour compiler le code VueJS (se trouvant dans `resource/js`) en javascript
- les commandes `git` pour récupérer les changements du dépôt distant et pour uploader les changements locaux vers le dép$ots distant

Ici sont présentés les commandes les plus utilisées pour le projet afin de donner une idée des commandes les plus importantes et utiles: 
- php artisan :
    - migrate
    - migrate:fresh (en développement uniquement, supprime la BD et recrée les tables)
    - migrate:fresh --seed (en développement uniquement, item que ci-dessus mais exécute en plus la classe `DatabaseSeeder` pour populer la base de données avec des données de tests)
    - make:seeder
    - make:controller
    - make:resource
    - make:model
    - make:migration
    - cache:clear
    - config:clear
- npm :
    - install (installe les paquets non installés présents dans le `package.json`)
    - run watch (lance une boucle écoutant sur les mises à jours du projet: recompile les composants VueJS en javascript à chaque fois qu'un composant est modifié)
- git :
    - add .
    - commit -m "message"
    - pull (important avant un push)
    - push

## Mise en production

Exécutez les commandes suivantes dans le répertoire du projet:

```
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
cp .env.example .env
```

Assurez-vous que qu'Apache ait des accès en écriture dans le projet:

```
sudo chgrp -R www-data <chemin/vers/le/projet>
```

Assurez-vous qu'un alias redirige vers le répertoire public du projet.

## README Laravel

Lien vers le README de Laravel: [README](README_Laravel.md)