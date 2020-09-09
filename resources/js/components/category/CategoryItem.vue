<template>
  <div class="mb-3">
    <b-card
      overlay
      v-b-hover="handleImageHover"
      :img-src="category.image_URI"
      img-height="256"
      img-width="256"
    >
        <b-row align-h="end">
          <b-button variant="danger" size="sm" @click="onDelete(category.id)" v-if="imageHovered">
            <i class="fas fa-trash"></i>
          </b-button>
        </b-row>
    </b-card>
    <b-card>{{ category.name }}</b-card>
  </div>
</template>

<script>
export default {
  props: {
    category: Object,
    delete: Function,
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
  },
};
</script>
