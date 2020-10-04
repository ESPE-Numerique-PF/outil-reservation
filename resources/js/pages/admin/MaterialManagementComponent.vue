<template>
  <b-container>
    <h2>Gestion du matériel</h2>

    <!-- Add category modal -->
    <add-material-modal
      id="add-material-modal"
    ></add-material-modal>

    <b-row class="mb-2">
    <!-- Add button -->
      <b-col cols="auto" class="mr-auto">
        <b-button v-b-modal.add-material-modal variant="light"><i class="fas fa-plus"></i> Créer</b-button>
      </b-col>
    </b-row>

    <!-- Material filter -->
    <b-row>
        
    </b-row>

    <!-- Material table -->
    <b-row>
        <ul>
          <li v-for="material in materials" :key="material.id">{{ material.name }}</li>
        </ul>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AddMaterialModal from "../../components/material/AddMaterialModal"

export default {
  components: {
    AddMaterialModal
  },
  data() {
    return {
    };
  },
  computed: {
    ...mapGetters({
      materials: "materials",
    })
  },
  methods: {
    ...mapActions({
      fetchMaterials: "fetchMaterials"
    }),
  },

  mounted() {
    this.fetchMaterials();
  },
};
</script>