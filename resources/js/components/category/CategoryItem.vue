<template>
  <div>
    <!-- UPDATE MODAL -->
    <update-category-modal :id="'update-category-modal-' + category.id" :category="category" :update="update"></update-category-modal>

    <!-- CARD -->
    <b-card
      v-b-hover="handleImageHover"
      :img-src="category.image_URI"
      img-height="128"
      img-width="128"
      img-left
      :title="category.name"
      @click="openUpdateCategoryModal"
      style="cursor: pointer"
    >
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
    delete: Function,
    update: Function
  },
  data() {
    return {
      imageHovered: false,
    };
  },
  methods: {
    onDelete() {
      this.delete(this.category.id);
    },
    handleImageHover(hovered) {
      this.imageHovered = hovered;
    },
    openUpdateCategoryModal() {
      this.$bvModal.show("update-category-modal-" + this.category.id);
    },
  },
};
</script>
