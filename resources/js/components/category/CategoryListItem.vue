<template>
  <div>
    <!-- UPDATE MODAL -->
    <update-category-modal
      :id="'update-category-modal-' + category.id"
      :category="category"
      :update="update"
    ></update-category-modal>

    <!-- CARD -->
    <b-card :img-src="category.image_URI" img-width="40" img-height="40" img-left no-body>
      <b-container>
        <b-row>
          <b-col>{{ category.name }}</b-col>
          <b-col class="m-1">
            <div class="float-right">
              <b-button @click="onUpdate" size="sm">
                <i class="fas fa-edit"></i>
              </b-button>
              <b-button variant="danger" @click="onDelete" size="sm">
                <i class="fas fa-trash"></i>
              </b-button>
            </div>
          </b-col>
        </b-row>
      </b-container>
    </b-card>
  </div>
</template>

<script>
import UpdateCategoryModal from "../../components/category/UpdateCategoryModal.vue";

export default {
  components: {
    UpdateCategoryModal,
  },
  props: {
    category: Object,
    update: Function,
    delete: Function,
  },
  data() {
    return {};
  },
  methods: {
    onUpdate() {
      this.$bvModal.show("update-category-modal-" + this.category.id);
    },

    onDelete() {
      this.delete(this.category.id);
    },
  },
};
</script>