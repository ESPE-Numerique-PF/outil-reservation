<template>
  <b-table
    id="material-instance-table"
    :fields="fields"
    :items="materials"
    @sort-changed="emitSortChangedEvent"
    sort-icon-left
    responsive
    hover
    no-local-sorting
    striped
    outlined
    stripped
  ></b-table>
</template>

<script>
export default {
  props: {
    materials: {
      type: Array,
      default: function () {
        return [];
      },
    },
    fields: {
      type: Array,
      default: function () {
        return [
          { key: "name", label: "Nom", sortable: true },
          { key: "reference", label: "Référence", sortable: true },
          { key: "category_name", label: "Catégorie", sortable: true },
          { key: "material_name", label: "Matériel", sortable: true },
        ];
      },
    },
  },
  methods: {
    emitSortChangedEvent(ctx) {
      this.$emit('sort-changed', ctx);
    }
  }
};
</script>

<style>
/* Table styling */
#material-instance-table th {
  padding-top: 0;
  padding-bottom: 0;
  vertical-align: middle;
}

#material-instance-table .fold-header {
  padding: 0;
}
</style>