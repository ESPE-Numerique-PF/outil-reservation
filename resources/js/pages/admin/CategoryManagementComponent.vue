<template>
  <b-container>
    <h1>Gestion des catégories</h1>

    <!-- Add category modal -->
    <add-category-modal
      id="add-category-modal"
    ></add-category-modal>

    <!-- Add button -->
    <b-row class="mb-3">
      <b-col md="auto">
        <b-button v-b-modal.add-category-modal pill>Créer</b-button>
      </b-col>
    </b-row>

    <!-- Custom tree -->
    <b-row>
      <b-col>
        <category-tree
          :value="categories"
          foldAllAfterMounted
          :dataFetchedAfterMounted="dataFetchedAfterMounted"
          @drop="moveCategory(categories)"
        >
          <template v-slot="{ node, path, tree }">
            <category-list-item
              :class="{ 'item-draggable': draggable }"
              :category="node"
              :path="path"
              :tree="tree"
            ></category-list-item>
          </template>
        </category-tree>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { cloneTreeData } from "he-tree-vue";
import CategoryTree from "../../components/category/CategoryTree";
import CategoryListItem from "../../components/category/CategoryListItem";
import AddCategoryModal from "../../components/category/AddCategoryModal";

export default {
  components: {
    CategoryTree,
    CategoryListItem,
    AddCategoryModal
  },
  data() {
    return {
      draggable: true,
      dataFetchedAfterMounted: false,
    };
  },
  computed: {
    ...mapGetters({
      categories: "categories",
    }),
  },
  methods: {
    ...mapActions({
      fetchCategories: "fetchCategories",
      moveCategory: "moveCategory",
    }),
  },

  mounted() {
    // sync call
    this.fetchCategories(() => {
      this.dataFetchedAfterMounted = true; // help to fold all item when tree is mounted
    });
  },
};
</script>