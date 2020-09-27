<template>
  <div v-b-hover="hovered">
    <!-- UPDATE MODAL -->
    <update-category-modal
      :id="'update-category-modal-' + category.id"
      :category="category"
      :update="update"
    ></update-category-modal>

    <!-- ADD MODAL -->
    <add-category-modal
      :id="'add-category-modal-' + category.id"
      :parentCategory="category"
      :add="add"
      :path="path"
      :tree="tree"
    ></add-category-modal>

    <!-- CARD -->
    <b-card no-body>
      <b-container>
        <b-row>
          <!-- TOGGLE FOLD BUTTON -->
          <b-button
            squared
            v-if="category.children && category.children.length"
            variant="light"
            size="sm"
            @click="tree.toggleFold(category, path)"
          >
            <span :key="category.$folded ? 'right' : 'down'">
              <i class="fas" :class="[category.$folded ? 'fa-caret-right' : 'fa-caret-down']" />
            </span>
          </b-button>

          <!-- IMAGE -->
          <b-img class="p-1" :src="category.image_URI" width="50" height="50" />
          <b-col>
            <h5 class="pt-3 pl-2">{{ category.name }}</h5>
          </b-col>
          <b-col class="m-1" v-if="isHovered">
            <!-- ADD, UPDATE AND DELETE BUTTON -->
            <div class="float-right pt-1">
              <b-button pill variant="light" @click="onAdd">
                <i class="fas fa-plus"></i>
              </b-button>
              <b-button pill variant="light" @click="onUpdate">
                <i class="fas fa-edit"></i>
              </b-button>
              <b-button pill variant="light" @click="onDelete">
                <i class="fas fa-trash"></i>
              </b-button>
            </div>
          </b-col>
        </b-row>
      </b-container>
    </b-card>
  </div>
</template>

<script>
import UpdateCategoryModal from "../../components/category/UpdateCategoryModal.vue";
import AddCategoryModal from "../../components/category/AddCategoryModal.vue";

export default {
  components: {
    UpdateCategoryModal,
    AddCategoryModal,
  },
  props: {
    category: Object,
    tree: Object,
    path: Array,
    node: Object,
    add: Function,
    update: Function,
    delete: Function,
  },
  data() {
    return {
      isHovered: false,
    };
  },
  methods: {
    onAdd() {
      this.$bvModal.show("add-category-modal-" + this.category.id);
    },
    onUpdate() {
      this.$bvModal.show("update-category-modal-" + this.category.id);
    },

    onDelete() {
      this.delete(this.category.id);
    },

    hovered(hovered) {
      this.isHovered = hovered;
    },
  },
};
</script>