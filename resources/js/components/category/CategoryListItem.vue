<template>
  <b-container>
    <b-row>
      <b-col>{{ category.name }}</b-col>
      <b-col>
        <b-button @click="onDelete">
          <i class="fas fa-trash"></i>
        </b-button>
        <b-button @click="onUpdate">
          <i class="fas fa-edit"></i>
        </b-button>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  components: {},
  props: {
    category: Object,
    update: Function,
    delete: Function,
  },
  data() {
    return {};
  },
  methods: {
    onUpdate() {
      console.log("update " + this.category.id);
    },

    onDelete() {
      console.log("delete" + this.category.id);
    },
  },
};
</script>