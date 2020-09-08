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

    <add-category-modal id="add-category-modal" :add="addCategory"></add-category-modal>

    <!-- CATEGORIES -->
    <div class="row my-3">
      <div class="col">
        <div class="card">
          <div class="card-header">Catégories de matériel</div>

          <div class="card-body">
            <ul>
              <li v-for="(category, idx) in categories" :key="category.id">
                <b-row>
                  <b-col class="pb-2">{{ category.name }}</b-col>
                  <b-col class="pb-2">
                    <b-button variant="danger" size="sm" @click="deleteCategory(category.id, idx)">
                      <i class="fas fa-trash"></i>
                    </b-button>
                  </b-col>
                </b-row>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";

export default {
  components: {
    AddCategoryModal,
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
        .then((response) => (this.categories = response.data))
        .catch((error) => console.log(error));
    },

    // delete a category from API and the view
    deleteCategory(id, idx) {
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
  },
  mounted() {
    this.getAllCategories();
  },
};
</script>
