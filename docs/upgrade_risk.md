# Risques de problème de compatibilité

Ce document liste les potentiels risques de non compatibilité liés à une mise à jour des outils.
Cette liste n'est pas exhausitve.

## Laravel

- les classes `Models` (ex: `App\User`) se trouvant dans `app/` sont déplacées dans un sous-dossier `Model/` dans la nouvelle version

## VueJS

- la librairie `vue-nestable` utilise une syntaxe des `slot` obsolète dans la version 3 de VueJS (voir la [documentation officelle](https://fr.vuejs.org/v2/guide/components-slots.html#Syntaxe-obsolete)).

    - Obsolète
```html
<slot-example>
  <template slot="default" slot-scope="slotProps">
    {{ slotProps.msg }}
  </template>
</slot-example>
```

    - Nouvelle version

```html
<current-user v-slot="slotProps">
  {{ slotProps.user.firstName }}
</current-user>
```