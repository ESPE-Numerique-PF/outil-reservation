<template>
  <div class="container">
    <b-card
      :title="category.name"
      :img-src="category.image_URI"
      class="mb-2"></b-card>
  </div>
</template>

<script>
export default {
  props: {
    category: Object
  },
  data() {
    return {};
  }
};
</script>
