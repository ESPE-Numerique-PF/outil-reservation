<template>
  <b-container fluid>
    
    <!-- Header -->
    <b-row class="py-3">
      <b-col>
        <b-button variant="validation" squared>
          <i class="fas fa-plus"></i> Ajouter
        </b-button>
      </b-col>
    </b-row>
    <!-- End header -->

    <!-- Material instance table -->
    <b-row>
      <b-col>
        <material-instance-table></material-instance-table>
      </b-col>
    </b-row>
    <!-- End material instance table -->

  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import MaterialInstanceTable from "@/components/material_instance/MaterialInstanceTable.vue";

export default {
  components: {
    MaterialInstanceTable,
  },
  data() {
    return {};
  },
};
</script>