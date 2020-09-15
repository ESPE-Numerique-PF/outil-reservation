<template>
  <div class="container">
    <h1>Gestion du matériel</h1>

    <!-- ADD CATEGORY MODAL -->

    <add-category-modal id="add-category-modal" :add="addCategory"></add-category-modal>

    <!-- CATEGORIES -->
    <b-row>
      <b-col>
        <b-card no-body class="mb-1">
          <!-- HEADER -->
          <b-navbar>
            <!-- LEFT SIDE NAV BAR -->
            <b-navbar v-b-toggle.collapse-category>
              <b-navbar-brand>Catégories</b-navbar-brand>
            </b-navbar>

            <!-- RIGHT SIDE NAV BAR -->
            <b-navbar class="ml-auto">

              <!-- SEARCH CATEGORY -->
              <b-nav-form>
                <b-input-group size="sm">
                  <template v-slot:prepend>
                    <b-input-group-text>
                      <i class="fas fa-search"></i>
                    </b-input-group-text>
                  </template>
                  <b-form-input placeholder="Rechercher" v-model="search.category"></b-form-input>
                </b-input-group>
              </b-nav-form>

              <!-- ADD CATEGOTY BUTTON -->
              <div class="mx-2">
                <b-button variant="primary" size="sm" v-b-modal.add-category-modal>
                  <span class="fas fa-plus"></span> Créer
                </b-button>
              </div>
            </b-navbar>
          </b-navbar>

          <!-- CATEGORY SET -->
          <b-collapse id="collapse-category" visible>
            <b-row class="p-2">
              <b-col
                v-for="category in categories.data"
                :key="category.id"
                class="mb-3 text-truncate"
                md="4"
                sm="6"
              >
                <category-item
                  :category="category"
                  :delete="deleteCategory"
                  :update="updateCategory"
                ></category-item>
              </b-col>
            </b-row>
          </b-collapse>
        </b-card>
      </b-col>
    </b-row>

    <!-- B-pagination -->
    <b-pagination
      v-model="currentPage"
      :total-rows="categories.meta.total"
      :per-page="categories.meta.per_page"
      limit="3"
      @change="getAllCategories"
    ></b-pagination>
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
      categories: {
        data: {},
        meta: {total: 0},
      },
      currentPage: 1,
      search: {
        category: "",
      },
    };
  },
  methods: {
    // fetch all categories through API
    getAllCategories(page = this.currentPage) {
      axios
        .get("/categories?page=" + page)
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
  },
  mounted() {
    this.getAllCategories();
  },
};
</script>
