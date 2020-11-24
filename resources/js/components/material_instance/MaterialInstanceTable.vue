<template>
  <b-table
    :fields="fields"
    responsive
    hover
    stripped
    outlined
  ></b-table>
</template>

<script>
export default {
  props: {
    fields: {
      type: Array,
      default: function () {
        return [
          { key: "name", label: "Nom", sortable: true },
          { key: "category_name", label: "Catégorie", sortable: true },
          { key: "material_instances_count", label: "Quantité" },
          { key: "show_details", label: "", thClass: "fold-header align" },
        ];
      },
    },
  },
};
</script>