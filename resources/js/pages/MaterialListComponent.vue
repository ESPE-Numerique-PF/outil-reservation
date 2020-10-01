<template>
  <div class="container">
    <h1>Matériel</h1>
    <ul>
      <li v-for="category in categories" :key="category.id">
          {{ category.name }}
      </li>
    </ul>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  computed: {
    ...mapGetters({
      categories: "categories",
    }),
  },
  methods: {
    ...mapActions({
      fetchCategories: "fetchCategories"
    })
  },
  mounted() {
    this.fetchCategories();
  }
 };
</script>
