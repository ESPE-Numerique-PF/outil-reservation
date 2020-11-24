<template>
  <b-container fluid>
    <!-- Header -->
    <b-row class="py-3">
      <b-col>
        <b-button>
          <i class="fas fa-plus"></i> Créer
        </b-button>
      </b-col>
    </b-row>

    <!-- Material instance table -->
    <b-row>
      <b-col>
        <material-instance-table></material-instance-table>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import MaterialInstanceTable from "../../components/material_instance/MaterialInstanceTable";

export default {
  components: {
    MaterialInstanceTable,
  },
  data() {
    return {};
  },
};
</script>