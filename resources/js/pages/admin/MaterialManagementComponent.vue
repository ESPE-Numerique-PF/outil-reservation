<template>
  <b-container fluid>
    <h2>Gestion du matériel</h2>

    <!-- Add material modal -->
    <add-material-modal id="add-material-modal" static lazy></add-material-modal>

    <b-row>
      <!-- Left side -->
      <b-col md="9" class="mb-3">
        <!-- Card left side -->
        <b-card no-body class="shadow">
          <!-- Header table menu -->
          <b-card-header class="p-1">
            <b-row>
              <b-col cols="auto" class="mr-auto">
                <b-button v-b-modal.add-material-modal variant="light">
                  <i class="fas fa-plus"></i> Créer
                </b-button>
              </b-col>
              <b-col cols="auto">
                <b-button variant="light">Tout étendre</b-button>
                <b-button variant="light">Tout réduire</b-button>
              </b-col>
            </b-row>
          </b-card-header>
          <b-card-body class="py-0">
            <b-row>
              <!-- Material table -->
              <b-table
                ref="materialTable"
                small
                responsive
                hover
                :items="materials"
                :fields="materialFields"
                primary-key="id"
              >
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
                  <update-material-modal
                    :id="'update-material-modal-' + row.item.id"
                    :material="row.item"
                  ></update-material-modal>

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
                    <!-- Toggle row details button -->
                    <b-button size="sm" variant="light" squared @click="row.toggleDetails">
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

                    <!-- Menu right side -->
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
                      <b-dropdown-item @click="onInstance(row.item)">
                        <i class="fas fa-laptop"></i> Instances
                      </b-dropdown-item>
                      <b-dropdown-item @click="onUpdate(row.item)">
                        <i class="fas fa-edit"></i> Editer
                      </b-dropdown-item>
                      <b-dropdown-item @click="beforeDelete(row.item)">
                        <i class="fas fa-trash"></i> Supprimer
                      </b-dropdown-item>
                    </b-dropdown>
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
          </b-card-body>
        </b-card>
      </b-col>

      <!-- Right side -->
      <b-col>
        <!-- Material filter -->
        <b-card no-body class="shadow">
          <b-card-header>
            <h5>
              <i class="fas fa-filter" /> Filtre
            </h5>
          </b-card-header>
          <b-card-body>
            <!-- Filter by category -->
            <b-row class="px-3">
              <b-form-group label="Par catégorie" label-class="form-label">
                <treeselect
                  placeholder="Choisissez une catégorie"
                  v-model="filter.categoriesId"
                  :options="categories"
                  :searchable="true"
                  :normalizer="normalizer"
                  :multiple="true"
                >
                  <template v-slot:option-label="{ node }">
                    {{
                    node.raw.name
                    }}
                  </template>
                  <template v-slot:value-label="{ node }">
                    {{
                    node.raw.name
                    }}
                  </template>
                </treeselect>
              </b-form-group>
            </b-row>

            <!-- FILTER button -->
            <b-row>
              <b-col>
                <b-button size="lg" @click="onFilter">Filtrer</b-button>
              </b-col>
            </b-row>
          </b-card-body>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AddMaterialModal from "../../components/material/AddMaterialModal";
import UpdateMaterialModal from "../../components/material/UpdateMaterialModal";

import Treeselect from "@riophae/vue-treeselect";
import "@riophae/vue-treeselect/dist/vue-treeselect.css";

export default {
  components: {
    AddMaterialModal,
    UpdateMaterialModal,
    Treeselect,
  },
  data() {
    return {
      materialFields: [
        { key: "selected", label: "" },
        { key: "name", label: "Nom" },
        { key: "category_name", label: "Catégorie" },
        { key: "material_instances_count", label: "Quantité" },
        { key: "show_details", label: "" },
      ],
      filter: {
        categoriesId: [],
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
    // TREESELECT
    normalizer(node) {
      return {
        id: node.id,
        label: node.name,
        children: node.children,
      };
    },
    // FILTER
    onFilter() {
      this.filterMaterials({ filters: this.filter });
    },
    // Table item operations
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