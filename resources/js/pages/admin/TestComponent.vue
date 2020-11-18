<template>
  <b-container class="py-3">
    <h1>Test</h1>
    <b-row>
      <b-table
        :items="items"
        :fields="fields"
        @sort-changed="sortingChanged"
        striped
        hover
        bordered
        no-local-sorting
        @row-dblclicked="onDblClick"
      >
        <!-- Header cells -->
        <template #head(btn)>
          <div class="align-content-end">
            <b-button squared variant="light">T</b-button>
          </div>
        </template>

        <!-- Data cells -->
        <template #cell(name)="{ item }">
          <b-form-input v-model="item.name" />
        </template>
      </b-table>
    </b-row>
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      fields: [
        { key: "name", label: "Name" },
        { key: "ref", label: "Reference" },
        { key: "material", label: "Family" },
        { key: "category", label: "Category" },
        { key: "btn", label: "", thClass: "btn-header" },
      ],
      items: [
        {
          id: 1,
          name: "ASUS 1",
          ref: "asus-001",
          material: "ASUS",
          category: "Computer",
        },
        {
          id: 2,
          name: "ASUS 2",
          ref: "asus-002",
          material: "ASUS",
          category: "Computer",
        },
        {
          id: 3,
          name: "ASUS 3",
          ref: "asus-003",
          material: "ASUS",
          category: "Computer",
        },
        {
          id: 4,
          name: "Dell 1",
          ref: "dell-001",
          material: "Dell",
          category: "Computer",
        },
        {
          id: 5,
          name: "Dell 2",
          ref: "dell-002",
          material: "Dell",
          category: "Computer",
        },
        {
          id: 6,
          name: "Ipad 1",
          ref: "ipad-001",
          material: "Ipad",
          category: "Tablet",
        },
        {
          id: 7,
          name: "Ipad 2",
          ref: "ipad-002",
          material: "Ipad",
          category: "Tablet",
        },
        {
          id: 8,
          name: "Robot 1",
          ref: "robot-001",
          material: "Robot",
          category: "Robot",
        },
        {
          id: 9,
          name: "Robot 2",
          ref: "robot-002",
          material: "Robot",
          category: "Robot",
        },
      ],
    };
  },
  methods: {
    sortingChanged(ctx) {
      console.log(ctx.sortBy);
      console.log(ctx.sortDesc);
    },
    onDblClick(item, index, event) {
      console.log(item.ref);
    },
  },
};
</script>

<style>
/* Header style */
.table th {
  padding: 0 12px;
  vertical-align: middle !important;
}

.btn-header {
  padding: 0 !important;
  align-content: end;
}
</style>
