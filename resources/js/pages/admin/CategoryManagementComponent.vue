<template>
  <b-container>
    <h1>Gestion des catégories</h1>

    <!-- Add category modal -->
    <add-category-modal
      id="add-category-modal"
    ></add-category-modal>

    <b-row class="mb-3">
    <!-- Add button -->
      <b-col cols="auto" class="mr-auto">
        <b-button v-b-modal.add-category-modal variant="light"><i class="fas fa-plus"></i> Créer</b-button>
      </b-col>
      <b-col cols="auto">
        <b-button variant="light" @click="unfoldAll">Tout étendre</b-button>
        <b-button variant="light" @click="foldAll">Tout réduire</b-button>
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
          ref="tree"
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
    tree() {
      return this.$refs.tree
    }
  },
  methods: {
    ...mapActions({
      fetchCategories: "fetchCategories",
      moveCategory: "moveCategory",
    }),
    foldAll() {
      this.tree.foldAll()
    },
    unfoldAll() {
      this.tree.unfoldAll()
    }
  },

  mounted() {
    // sync call
    this.fetchCategories(() => {
      this.dataFetchedAfterMounted = true; // help to fold all item when tree is mounted
    });
  },
};
</script>