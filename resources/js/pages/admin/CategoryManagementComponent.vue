<template>
  <b-container>
    <h1>Gestion des catégories</h1>

    <!-- ADD CATEGORY MODAL -->
    <add-category-modal id="add-category-modal" :add="addCategory"></add-category-modal>

    <!-- CATEGORIES CARD -->
    <b-card no-body>
      <b-card-header>
        <b-row class="justify-content-md-end">
          <!-- ADD BUTTON -->
          <b-col>
            <b-button pill variant="light" v-b-modal.add-category-modal>
              <i class="fas fa-plus" /> Créer
            </b-button>
          </b-col>

          <!-- TOGGLE EDIT MODE -->
          <b-col sm="auto">
            <b-form-checkbox class="pt-2" v-model="draggable" switch>Mode édition</b-form-checkbox>
          </b-col>
        </b-row>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col>
            <tree v-model="categories" :draggable="draggable">
              <template v-slot="{node, path, tree}">
                <category-list-item
                  :class="{'item-draggable': draggable}"
                  :tree="tree"
                  :path="path"
                  :category="node"
                  :add="addCategory"
                  :update="updateCategory"
                  :delete="deleteCategory"
                ></category-list-item>
              </template>
            </tree>
          </b-col>
        </b-row>
      </b-card-body>
    </b-card>
  </b-container>
</template>

<script>
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";
import CategoryListItem from "../../components/category/CategoryListItem.vue";

import { Tree, Fold, Draggable } from "he-tree-vue";

export default {
  components: {
    AddCategoryModal,
    CategoryListItem,
    Tree: Tree.mixPlugins([Fold, Draggable]),
  },
  data() {
    return {
      categories: [],
      draggable: false,
      show: true,
    };
  },
  methods: {
    log(obj) {
      console.log(obj);
    },
    // fetch all categories through API
    getAllCategories() {
      axios
        .get("/categories")
        .then((response) => {
          this.categories = response.data;
          this.initialPositionCategories = response.data;
        })
        .catch((error) => console.log(error));
    },

    // delete a category from API and the view
    deleteCategory(id) {
      axios
        .delete("/categories/" + id)
        .then((response) => {
          this.getAllCategories();
        })
        .catch((error) => console.log(error));
    },

    // add a category through API and the view (+ dismiss add category modal)
    addCategory(category, callbackOnSuccess, callbackOnError) {
      axios
        .post("/categories", category)
        .then((response) => {
          this.getAllCategories();
          callbackOnSuccess();
        })
        .catch((error) => callbackOnError(error));
    },

    updateCategory(id, category, callbackOnSuccess, callbackOnError) {
      axios
        .post("/categories/" + id, category)
        .then((response) => {
          this.getAllCategories();
          callbackOnSuccess();
        })
        .catch((error) => callbackOnError(error));
    },

    onMovement() {
      // TODO
      axios
        .post("/categories/move", this.categories)
        .then((response) => {
          // this.getAllCategories()
          console.log("moved");
        })
        .catch((error) => console.log(error));

      console.log("move");
    },
  },
  mounted() {
    this.getAllCategories();
  },
};
</script>

<style>
.he-tree--hidden {
  display: none;
}
.he-tree--rtl {
  direction: rtl;
}

/* .he-tree .tree-placeholder-node {
} */
.he-tree .dragging .tree-node-back:hover {
  background-color: inherit;
}

.item-draggable {
  cursor: grab;
}
</style>