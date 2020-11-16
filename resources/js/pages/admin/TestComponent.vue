<template>
  <b-container>
    <h1>Test</h1>
    <b-row>
      <b-table :items="items" :fields="fields" @sort-changed="sortingChanged" striped hover bordered no-local-sorting></b-table>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        { key: "name", label: "Name", sortable: true},
        { key: "ref", label: "Reference", sortable: true},
        { key: "material", label: "Family", sortable: true},
        { key: "category", label: "Category", sortable: true},
      ],
      items: [
        { id: 1, name: "ASUS 1", ref: "asus-001", material: "ASUS", category: "Computer" },
        { id: 2, name: "ASUS 2", ref: "asus-002", material: "ASUS", category: "Computer" },
        { id: 3, name: "ASUS 3", ref: "asus-003", material: "ASUS", category: "Computer" },
        { id: 4, name: "Dell 1", ref: "dell-001", material: "Dell", category: "Computer" },
        { id: 5, name: "Dell 2", ref: "dell-002", material: "Dell", category: "Computer" },
        { id: 6, name: "Ipad 1", ref: "ipad-001", material: "Ipad", category: "Tablet" },
        { id: 7, name: "Ipad 2", ref: "ipad-002", material: "Ipad", category: "Tablet" },
        { id: 8, name: "Robot 1", ref: "robot-001", material: "Robot", category: "Robot" },
        { id: 9, name: "Robot 2", ref: "robot-002", material: "Robot", category: "Robot" },
      ],
    };
  },
  methods: {
    sortingChanged(ctx) {
      console.log(ctx.sortBy);
      console.log(ctx.sortDesc);
    }
  }
};
</script>
