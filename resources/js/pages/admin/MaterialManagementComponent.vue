<template>
  <b-container fluid>
    <!-- <h2>Matériel</h2> -->

    <!-- Add material modal -->
    <add-material-modal id="add-material-modal" static lazy></add-material-modal>

    <!-- Header -->
    <b-row class="py-3" id="material-options-row">
      <!-- Create material button -->
      <b-col cols="auto">
        <b-button v-b-modal.add-material-modal variant="success" squared>
          <i class="fas fa-plus"></i> Créer
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

    <!-- Materials table -->
    <b-row>
      <b-table
        id="material-table"
        class="px-3"
        primary-key="id"
        ref="materialTable"
        :items="materials"
        :fields="materialFields"
        :busy.sync="table.isBusy"
        @sort-changed="sortingChanged"
        sort-icon-left
        responsive
        hover
        no-local-sorting
        striped
        outlined
      >
        <!-- Custom header rendering -->
        <template #head(show_details)>
          <div class="d-flex justify-content-end">
            <b-button size="lg" variant="secondary" squared @click="toggleFoldAll" class="header-btn">
              <span :key="table.isFolded ? 'up' : 'down'">
                <i class="fas" :class="[table.isFolded ? 'fa-caret-up' : 'fa-caret-down']" />
              </span>
            </b-button>
          </div>
        </template>

        <!-- Custom data rendering (category name) -->
        <template #cell(category_name)="{ item }">
          <span
            v-if="item.category != null"
            class="text-secondary font-italic"
          >{{ item.category.name }}</span>
        </template>

        <!-- Material instances count -->
        <template #cell(material_instances_count)="{ item }">
          <span class="font-italic">{{ item.material_instances_count }}</span>
        </template>

        <!-- Row details button and modals -->
        <template #cell(show_details)="row">
          <!-- Update modal -->
          <update-material-modal :id="'update-material-modal-' + row.item.id" :material="row.item"></update-material-modal>

          <!-- Delete Modal -->
          <b-modal
            :id="'delete-material-modal-' + row.item.id"
            :title="'Suppression du matériel ' + row.item.name"
            cancel-title="Annuler"
            ok-title="Supprimer"
            ok-variant="danger"
            @ok="onDelete(row.item)"
          >
            <h3>Attention</h3>
            <p>La suppression de ce matériel sera définitive.</p>
            <p>Etes-vous sûrs de vouloir continuer ?</p>
          </b-modal>

          <!-- Buttons -->
          <div class="float-right">
            <b-button size="sm" variant="light" squared @click="onInstance(row.item)">
              <i class="fas fa-laptop" />
            </b-button>
            <b-button size="sm" variant="light" squared @click="onUpdate(row.item)">
              <i class="fas fa-edit" />
            </b-button>
            <b-button size="sm" variant="danger" squared @click="beforeDelete(row.item)">
              <i class="fas fa-trash" />
            </b-button>
            <b-button size="sm" variant="light" squared @click="row.toggleDetails">
              <span :key="row.detailsShowing ? 'up' : 'down'">
                <i class="fas" :class="[row.detailsShowing ? 'fa-caret-up' : 'fa-caret-down']" />
              </span>
            </b-button>
          </div>
        </template>

        <!-- Row details -->
        <template #row-details="{ item }">
          <b-card no-body class="p-2">
            <b-row>
              <b-col cols="auto">
                <b-img :src="item.image_URI" width="100" height="100" />
              </b-col>
              <b-col>
                <h5>Description:</h5>
                <span v-html="item.description"></span>
              </b-col>
              <b-col>
                <h5>Note:</h5>
                <span v-html="item.note"></span>
              </b-col>
            </b-row>
          </b-card>
        </template>
      </b-table>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AddMaterialModal from "../../components/material/AddMaterialModal";
import UpdateMaterialModal from "../../components/material/UpdateMaterialModal";
import CategoryTreeSelect from "../../components/category/CategoryTreeSelect";

import TreeSelect from "@riophae/vue-treeselect";
import "@riophae/vue-treeselect/dist/vue-treeselect.css";

export default {
  components: {
    TreeSelect,
    AddMaterialModal,
    UpdateMaterialModal,
    CategoryTreeSelect,
  },
  data() {
    return {
      materialFields: [
        // { key: "selected", label: "" }, // TODO grouped actions on selected items
        { key: "name", label: "Nom", sortable: true },
        { key: "category_name", label: "Catégorie", sortable: true },
        { key: "material_instances_count", label: "Quantité" },
        { key: "show_details", label: "", thClass: "fold-header align" },
      ],
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
    // Table item operations
    toggleFoldAll() {
      // get material table and iterate on all rows to toggle details
      this.table.isFolded = !this.table.isFolded;
      this.materials.forEach(material => material._showDetails = this.table.isFolded);

    },
    onInstance(material) {
      // TODO show material instances view for material
      console.log("instance");
      console.log(material);
    },
    onUpdate(material) {
      this.$bvModal.show("update-material-modal-" + material.id);
    },
    beforeDelete(material) {
      this.$root.$emit(
        "bv::show::modal",
        "delete-material-modal-" + material.id
      );
    },
    onDelete(material) {
      this.$store.dispatch("deleteMaterial", material);
    },
  },

  mounted() {
    this.fetchMaterials();
    this.fetchCategories();
  },
};
</script>

<style>
/* Table styling */
#material-options-row {
  /* background: #f2f2f2; */
}

#material-table th {
  padding-top: 0;
  padding-bottom: 0;
  vertical-align: middle;
}

#material-table .fold-header {
  padding: 0;
}
</style>