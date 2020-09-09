<template>
  <div class="container">
    <b-card :title="category.name" :img-src="category.image_URI" class="mb-2">
      <b-button variant="danger" size="sm" @click="onDelete(category.id)">
        <i class="fas fa-trash"></i>
      </b-button>
    </b-card>
  </div>
</template>

<script>
export default {
  props: {
    category: Object,
    delete: Function,
  },
  data() {
    return {};
  },
  methods: {
    onDelete() {
      this.delete(this.category.id);
    },
  },
};
</script>
