<template>
  <div v-b-hover="hovered">
    <!-- UPDATE MODAL -->
    <update-category-modal
      :id="'update-category-modal-' + category.id"
      :category="category"
      :update="update"
    ></update-category-modal>

    <!-- ADD MODAL -->
    <add-category-modal
      :id="'add-category-modal-' + category.id"
      :parentCategory="category"
      :add="add"
    ></add-category-modal>

    <!-- CARD -->
    <b-card :img-src="category.image_URI" img-width="40" img-height="40" img-left no-body>
      <b-container>
        <b-row>
          <b-col>{{ category.name }}</b-col>
          <b-col class="m-1" v-if="isHovered">
              <!-- ADD, UPDATE AND DELETE BUTTON -->
            <div class="float-right">
              <b-button pill variant="light" @click="onAdd" size="sm">
                <i class="fas fa-plus"></i>
              </b-button>
              <b-button pill variant="light" @click="onUpdate" size="sm">
                <i class="fas fa-edit"></i>
              </b-button>
              <b-button pill variant="light" @click="onDelete" size="sm">
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
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";

export default {
  components: {
    UpdateCategoryModal,
    AddCategoryModal,
  },
  props: {
    category: Object,
    add: Function,
    update: Function,
    delete: Function,
  },
  data() {
    return {
      isHovered: false
    };
  },
  methods: {
    onAdd() {
      this.$bvModal.show("add-category-modal-" + this.category.id);
    },
    onUpdate() {
      this.$bvModal.show("update-category-modal-" + this.category.id);
    },

    onDelete() {
      this.delete(this.category.id);
    },

    hovered(hovered) {
      this.isHovered = hovered
    }
  },
};
</script>