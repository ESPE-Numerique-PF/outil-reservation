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
              <i class="fas fa-plus"></i> Créer
            </b-button>
          </b-col>

          <!-- TOGGLE EDIT MODE -->
          <b-col sm="auto">
            <b-form-checkbox v-model="draggable" switch>Mode édition</b-form-checkbox>
          </b-col>
        </b-row>
      </b-card-header>
      <b-card-body>
        <b-row>
          <b-col>
            <vue-nestable v-model="categories" @change="onMovement">
              <vue-nestable-handle :draggable="draggable" slot-scope="{ item }" :item="item">
                <category-list-item
                  :category="item"
                  :add="addCategory"
                  :update="updateCategory"
                  :delete="deleteCategory"
                  :draggable="draggable"
                ></category-list-item>
              </vue-nestable-handle>
            </vue-nestable>
          </b-col>
        </b-row>
      </b-card-body>
    </b-card>
  </b-container>
</template>

<script>
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";
import CategoryListItem from "../../components/category/CategoryListItem.vue";

export default {
  components: {
    AddCategoryModal,
    CategoryListItem,
  },
  data() {
    return {
      categories: [],
      draggable: false,
    };
  },
  methods: {
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
/*
* Style for nestable
*/
.nestable {
  position: relative;
}
.nestable-rtl {
  direction: rtl;
}
.nestable .nestable-list {
  margin: 0;
  padding: 0 0 0 40px;
  list-style-type: none;
}
.nestable-rtl .nestable-list {
  padding: 0 40px 0 0;
}
.nestable > .nestable-list {
  padding: 0;
}
.nestable-item,
.nestable-item-copy {
  margin: 10px 0 0;
}
.nestable-item:first-child,
.nestable-item-copy:first-child {
  margin-top: 0;
}
.nestable-item .nestable-list,
.nestable-item-copy .nestable-list {
  margin-top: 10px;
}
.nestable-item {
  position: relative;
}
.nestable-item.is-dragging .nestable-list {
  pointer-events: none;
}
.nestable-item.is-dragging * {
  opacity: 0;
  filter: alpha(opacity=0);
}
.nestable-item.is-dragging:before {
  content: " ";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0, 0, 0, 0.089);
  /* border: 1px dashed rgb(73, 100, 241); */
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
.nestable-drag-layer {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 100;
  pointer-events: none;
}
.nestable-rtl .nestable-drag-layer {
  left: auto;
  right: 0;
}
.nestable-drag-layer > .nestable-list {
  position: absolute;
  top: 0;
  left: 0;
  padding: 0;
  /* background-color: rgba(106, 127, 233, 0.274); */
}
.nestable-rtl .nestable-drag-layer > .nestable-list {
  padding: 0;
}
.nestable [draggable="true"] {
  cursor: grab;
}
.nestable [draggable="false"] {
  cursor: default;
}
.nestable-handle {
  display: inline;
}
</style>