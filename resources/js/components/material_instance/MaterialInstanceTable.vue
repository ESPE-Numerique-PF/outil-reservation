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
          { key: "reference", label: "Référence", sortable: true },
          { key: "name", label: "Nom", sortable: true },
          { key: "category_name", label: "Catégorie", sortable: true },
          { key: "material_name", label: "Matériel", sortable: true },
          { key: "options", label: "" },
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

<style lang="scss">

$paddingHeader: 0.25rem;

#material-instance-table th {
  padding-top: $paddingHeader;
  padding-bottom: $paddingHeader;
  vertical-align: middle;
}

#material-instance-table .fold-header {
  padding: 0;
}
</style>