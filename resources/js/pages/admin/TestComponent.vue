<template>
  <b-container>
    <!-- Button add -->
    <b-row class="mb-3">
      <b-button v-b-modal.add-test-category-modal>Add</b-button>
    </b-row>

    <!-- Modal create category -->
    <add-test-category-modal id="add-test-category-modal"></add-test-category-modal>

    <!-- List of categories -->
    <b-row>
      <ul>
        <li v-for="category in categories" :key="category.id">
          <b-row class="justify-content-md-end mb-2">
            <b-col>
              {{ category.name }}
            </b-col>
            <b-col md="auto">
              <b-button
                @click="deleteCategory(category)"
                size="sm"
                class="mx-2"
                variant="danger"
                >Delete</b-button
              >
            </b-col>
          </b-row>
        </li>
      </ul>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import AddTestCategoryModal from '../../components/AddTestCategoryModal'

export default {
  components: {
    AddTestCategoryModal
  },
  computed: {
    ...mapGetters({
      categories: "categories",
    }),
  },
  methods: {
    ...mapActions({
      deleteCategory: "deleteCategory",
      fetchCategories: "fetchCategories"
    }),
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>
