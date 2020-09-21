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

- Créer une base de données `outil-reservation` et `outil-reservation-test` (cette dernière est optionnelle et ne sert que pour les tests exécutées durant le développement)
- Créer un utilisateur `outil-reservation` avec tous les droits sur la(les) base(s) de données précédente(s)

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

Initialiser le fichier environnement (contient des paramètres propres à l'environnement) en copiant le fichier d'exemple et en renseignant les paramètres (les plus importants sont les champs `APP_NAME`, `APP_URL`, `DB_DATABASE=outil-reservation`, `DB_USERNAME`, `DB_PASSWORD`):
```
cp .env.example .env
```
Initialiser ensuite la clé de l'application (la clé sera automatiquement ajouter à l'entrée `APP_KEY` dans le fichier `.env`):
```
php artisan key:generate
```

Initialiser les configurations du projet dans les fichiers suivants:
- `config/app.php`
- `config/database.php`

Puis initialiser la base de données:
```
php artisan migrate
```

#### Configuration pour les tests (optionnel)

Optionnellement, dans le cas où vous effectuerez des tests unitaires, il est conseillé de créer en plus un fichier `.env.testing` qui sera la copie du fichier `.env` avec comme paramètres à modifier le `DB_DATABASE=outil-reservation-test`. Ainsi, les tests n'écriront que dans la base de données de test sans toucher à la base de données principale.
```
cp .env .env.testing
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

## Tests unitaires

Le projet inclut des tests unitaires à l'aide de l'outil `PHPUnit` fournit avec Laravel.
Les tests se trouvent dans le dossier `tests`.
Pour exécuter l'ensemble des tests:
```
php artisan test
```

## Mise en production

Exécutez les commandes suivantes dans le répertoire du projet:

```
cd <chemin/vers/le/projet>
git pull
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
npm install
npm run production
sudo chgrp -R www-data .
sudo chmod -R g+rw .
cp .env.example .env
```

Assurez-vous qu'Apache ait des accès en écriture dans le projet:

```
cd <chemin/vers/le/projet>
sudo chgrp -R www-data .
sudo chmod -R g+rw .
```

Assurez-vous qu'un alias (défini dans les fichiers de configuration d'Apache) redirige vers le répertoire public du projet `public/`. Par exemple, dans un fichier de configuration apache se trouvant dans `/etc/apache2/conf-available/my-conf.conf`:
```
Alias /outil-reservation    /var/www/html/outil-reservation/public
```

### Mise à jour en production

Pour mettre à jour l'outil sur le serveur de production, exécutez:
```
cd <chemin/vers/le/projet>
git pull
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
npm install
npm run production
sudo chgrp -R www-data .
sudo chmod -R g+rw .
```

Assurez-vous que le fichier `.env` soit à jour avec le fichier `.env.example` (si des champs ont été ajoutés/modifiés dans `.env.example`, ces champs doivent être répliqués dans `.env` et les valeurs doivent être ajustées en fonction de la configuration du serveur).

## README Laravel

Lien vers le README de Laravel: [README](README_Laravel.md)