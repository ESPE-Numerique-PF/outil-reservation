# Risques de problème de compatibilité

Ce document liste les potentiels risques de non compatibilité liés à une mise à jour des outils.
Cette liste n'est pas exhausitve.

## Laravel

- les classes `Models` (ex: `App\User`) se trouvant dans `app/` sont doivent être déplacées dans un sous-dossier `Model/` dans la nouvelle version

## VueJS

- la librairie `vue-nestable` utilise une syntaxe des `slot` obsolète dans la version 3