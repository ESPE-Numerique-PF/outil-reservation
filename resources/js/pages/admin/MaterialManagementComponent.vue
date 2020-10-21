<template>
  <b-container>
    <h2>Gestion du matériel</h2>

    <!-- Add category modal -->
    <add-material-modal id="add-material-modal"></add-material-modal>

    <b-row>
      <!-- Left side -->
      <b-col md="9" class="mb-3">
        <!-- Card left side -->
        <b-card no-body class="shadow">
          <b-card-header class="p-1">
            <!-- Add button -->
            <b-row>
              <b-col cols="auto" class="mr-auto">
                <b-button v-b-modal.add-material-modal variant="light"
                  ><i class="fas fa-plus"></i> Créer</b-button
                >
              </b-col>
            </b-row>
          </b-card-header>
          <!-- Material table -->
          <b-card-body class="py-0">
            <b-row>
              <b-table
                small
                responsive
                hover
                :items="filteredMaterials"
                :fields="materialFields"
                primary-key="id"
              >
                <!-- Row details button -->
                <template v-slot:cell(show_details)="row">
                  <div class="float-right">
                    <b-button
                      size="sm"
                      variant="light"
                      squared
                      @click="row.toggleDetails"
                    >
                      <span :key="row.detailsShowing ? 'left' : 'down'">
                        <i
                          class="fas"
                          :class="[
                            row.detailsShowing
                              ? 'fa-caret-left'
                              : 'fa-caret-down',
                          ]"
                        />
                      </span>
                    </b-button>
                    <!-- Menu -->
                    <b-dropdown
                      class="borderless"
                      variant="light"
                      size="sm"
                      :id="'dropdown-' + row.item.id"
                      no-caret
                    >
                      <template v-slot:button-content>
                        <i class="fas fa-ellipsis-v" />
                      </template>
                      <b-dropdown-item @click="onUpdate(row.item)">Editer</b-dropdown-item>
                      <b-dropdown-item>Supprimer</b-dropdown-item>
                    </b-dropdown>
                  </div>
                </template>
                <!-- Row details -->
                <template v-slot:row-details="row">
                  <b-card no-body class="p-2">
                    <b-row>
                      <b-col cols="auto">
                        <b-img
                          :src="row.item.image_URI"
                          width="100"
                          height="100"
                        />
                      </b-col>
                      <b-col>
                        <h5>Description:</h5>
                        <p>{{ row.item.description }}</p>
                      </b-col>
                      <b-col>
                        <h5>Note:</h5>
                        <p>{{ row.item.note }}</p>
                      </b-col>
                    </b-row>
                  </b-card>
                </template>
              </b-table>
            </b-row>
          </b-card-body>
        </b-card>
      </b-col>

      <!-- Right side -->
      <b-col>
        <!-- Material filter -->
        <b-card no-body class="shadow">
          <b-card-header>
            <h5><i class="fas fa-filter" /> Filtre</h5>
          </b-card-header>
          <b-card-body></b-card-body>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AddMaterialModal from "../../components/material/AddMaterialModal";
import UpdateMaterialModal from "../../components/material/UpdateMaterialModal";

export default {
  components: {
    AddMaterialModal,
    UpdateMaterialModal
  },
  data() {
    return {
      materialFields: [
        // TODO image
        { key: "name", label: "Nom" },
        { key: "category_id", label: "Catégorie" },
        { key: "material_instances_count", label: "Quantité" },
        { key: "show_details", label: "" },
      ],
    };
  },
  computed: {
    ...mapGetters({
      materials: "materials",
    }),
    filteredMaterials() {
      return this.materials;
    },
  },
  methods: {
    ...mapActions({
      fetchMaterials: "fetchMaterials",
    }),
    onRowSelected(items) {
      this.selected = items;
    },
    onUpdate(material) {
      // TODO open update modal
      console.log("update " + material.name);
    },
    beforeDelete(material) {
      // TODO open delete confirmation modal
      console.log("delete " + material.name);
    },
  },

  mounted() {
    this.fetchMaterials();
  },
};
</script>