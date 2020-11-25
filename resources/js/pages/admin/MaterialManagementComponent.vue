<template>
  <b-container fluid>
    <!-- Add material modal -->
    <add-material-modal id="add-material-modal" static lazy></add-material-modal>

    <!-- Header -->
    <b-row class="py-3" id="material-options-row">

      <!-- Create material button -->
      <b-col cols="auto">
        <b-button v-b-modal.add-material-modal variant="validation" squared>
          <i class="fas fa-plus"></i> Ajouter
        </b-button>
      </b-col>

      <!-- Filter buttons -->
      <b-col cols="5" class="ml-auto">
        <category-tree-select v-model="filter.categoriesId" :options="categories" />
      </b-col>
      <b-col cols="auto">
        <b-button @click="filteringByCategory" squared>Rechercher</b-button>
      </b-col>
    </b-row>
    <!-- End header -->

    <!-- Materials table -->
    <b-row>
      <b-col>
        <material-table :materials="materials" @sort-changed="sortingChanged"></material-table>
      </b-col>
    </b-row>
    <!-- End materials table -->
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import MaterialTable from "@/components/material/MaterialTable";
import AddMaterialModal from "@/components/material/AddMaterialModal";
import CategoryTreeSelect from "@/components/category/CategoryTreeSelect";

export default {
  components: {
    MaterialTable,
    AddMaterialModal,
    CategoryTreeSelect,
  },
  data() {
    return {
      filter: {
        categoriesId: [],
      },
      table: {
        isBusy: false,
        isFolded: false,
      },
    };
  },
  computed: {
    ...mapGetters({
      materials: "materials",
      categories: "categories",
    }),
  },
  methods: {
    // STORE
    ...mapActions({
      fetchMaterials: "fetchMaterials",
      filterMaterials: "filterMaterials",
      fetchCategories: "fetchCategories",
    }),
    // FILTER
    filteringByCategory() {
      this.table.isBusy = true;
      this.filterMaterials({
        filters: {
          categoriesId: this.filter.categoriesId,
        },
      })
        .then((response) => {
          this.table.isBusy = false;
        })
        .catch((error) => {
          console.log(error);
          this.table.isBusy = false;
        });
    },
    sortingChanged(ctx) {
      this.table.isBusy = true;
      this.filterMaterials({
        filters: {
          sortBy: ctx.sortBy,
          sortDesc: ctx.sortDesc,
          categoriesId: this.filter.categoriesId,
        },
      })
        .then((response) => {
          this.table.isBusy = false;
        })
        .catch((error) => {
          console.log(error);
          this.table.isBusy = false;
        });
    },
  },
  mounted() {
    this.fetchMaterials();
    this.fetchCategories();
  },
};
</script>