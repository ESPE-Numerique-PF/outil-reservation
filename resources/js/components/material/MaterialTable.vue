<template>
  <b-table
    id="material-table"
    class="px-3"
    primary-key="id"
    :items="materials"
    :fields="fields"
    @sort-changed="emitSortChangedEvent"
    sort-icon-left
    responsive
    hover
    no-local-sorting
    striped
    outlined
    details-td-class="p-0"
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
      <span v-if="item.category != null" class="text-secondary font-italic">{{ item.category.name }}</span>
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
    <template #row-details="{ item }" class="p-0">
      <b-row class="p-3 bg-white">
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
    </template>
  </b-table>
</template>

<script>
import UpdateMaterialModal from "../../components/material/UpdateMaterialModal";

export default {
  components: {
    UpdateMaterialModal,
  },
  props: {
    id: {
      type: String,
      default: "material-table",
    },
    materials: {
      type: Array,
      default: function () {
        return []},
    },
    fields: {
      type: Array,
      default: function () {
        return [
        // { key: "selected", label: "" }, // TODO grouped actions on selected items
        { key: "name", label: "Nom", sortable: true },
        { key: "category_name", label: "Catégorie", sortable: true },
        { key: "material_instances_count", label: "Quantité" },
        { key: "show_details", label: "", thClass: "fold-header align" },
      ]},
    },
    sortingChanged: {
      type: Function,
      default: function () {},
    },
  },
  data() {
    return {
      table: {
        isFolded: false,
      },
    };
  },
  methods: {
    // Events
    emitSortChangedEvent(ctx) {
      this.$emit('sort-changed', ctx);
    },

    toggleFoldAll() {
      // add / set _showDetails property to each material respecting VueJS Reactivity in Depth
      this.table.isFolded = !this.table.isFolded;
      this.materials.forEach(
        (material) => (Vue.set(material, '_showDetails', this.table.isFolded))
      );
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
};
</script>

<style> 
/* Table styling */
#material-table th {
  padding-top: 0;
  padding-bottom: 0;
  vertical-align: middle;
}

#material-table .fold-header {
  padding: 0;
}
</style>