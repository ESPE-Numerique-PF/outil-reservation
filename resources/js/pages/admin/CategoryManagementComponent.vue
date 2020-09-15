<template>
  <div class="container">
    <h1>Gestion des catégories</h1>

    <!-- ADD CATEGORY MODAL -->

    <!-- <add-category-modal id="add-category-modal" :add="addCategory"></add-category-modal> -->

    <pre>{{ categories }}</pre>
    <!-- {{ categories }} -->
    <pre>{{ nestedCategories }}</pre>

    <!-- CATEGORIES -->
    <!-- <nestable-list :data="nestableItems" item="item">
      <template v-slot="{ item }">
        <b-row>
          <b-col>
            <i class="fas fa-grip-vertical"></i> {{ item }}
          </b-col>
        </b-row>
      </template>
    </nestable-list>-->

    <!-- <vue-nestable v-model="nestableItems">
      <vue-nestable-handle slot-scope="{ item }" :item="item">
        <nestable-item :item="item"></nestable-item>
      </vue-nestable-handle>
    </vue-nestable> -->
  </div>
</template>

<script>
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";
import CategoryItem from "../../components/category/CategoryItem.vue";
import NestableItem from "../../components/category/NestableItem.vue";

export default {
  components: {
    AddCategoryModal,
    CategoryItem,
    NestableItem,
  },
  data() {
    return {
      categories: {},
      nestedCategories: [],
      nestableItems: [
        {
          id: 0,
          text: "Andy",
        },
        {
          id: 1,
          text: "Harry",
          children: [
            {
              id: 2,
              text: "David",
            },
          ],
        },
        {
          id: 3,
          text: "Lisa",
        },
      ],
      search: {
        category: "",
      },
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

    log(message) {
      console.log(message);
    },
  },

  computed: {
    nestedCategories() {
      return []
    }
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
  background-color: rgba(106, 127, 233, 0.274);
  border: 1px dashed rgb(73, 100, 241);
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
  background-color: rgba(106, 127, 233, 0.274);
}
.nestable-rtl .nestable-drag-layer > .nestable-list {
  padding: 0;
}
.nestable [draggable="true"] {
  cursor: move;
}
.nestable-handle {
  display: inline;
}
</style>