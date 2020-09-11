<template>
  <div class="container">
    <h1>Gestion du matériel</h1>

    <!-- ADD CATEGORY -->
    <div class="row my-3">
      <div class="col">
        <b-button class="btn btn-primary" v-b-modal.add-category-modal>
          <span class="fas fa-plus"></span> Ajouter une catégorie
        </b-button>
      </div>
    </div>

    <!-- TEST -->
    <b-button @click="test">Test</b-button>

    <add-category-modal id="add-category-modal" :add="addCategory"></add-category-modal>

    <!-- CATEGORIES -->
    <b-row>
      <b-col>
        <b-card header="Catégories">
          <b-row>
            <b-col v-for="category in categories" :key="category.id" class="mb-3" cols="4">
              <category-item :category="category" :delete="deleteCategory" :update="updateCategory"></category-item>
            </b-col>
          </b-row>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";
import CategoryItem from "../../components/category/CategoryItem.vue";

export default {
  components: {
    AddCategoryModal,
    CategoryItem,
  },
  data() {
    return {
      categories: [],
    };
  },
  methods: {
    // fetch all categories through API
    getAllCategories() {
      axios
        .get("/categories")
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => console.log(error));
    },

    // delete a category from API and the view
    deleteCategory(id) {
      axios
        .delete("/categories/" + id)
        .then((response) => {
          console.log("delete");
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

    test() {
      let formData = new FormData();
      formData.append("id", 2);
      formData.append("name", " Test 1");
      formData.append("value", 200);
      formData.append("bool", true);

      let data = {
        id: 2,
        name: "Test 1",
        value: 200,
        bool: true,
      };
      axios
        .post("/test", data)
        .then((response) => console.log(response))
        .catch((error) => console.log(error));
    },
  },
  mounted() {
    this.getAllCategories();
  },
};
</script>
