<template>
  <b-card :img-src="category.image_URI" img-width="40" img-height="40" img-left no-body>
    <b-container>
      <b-row>
        <b-col>{{ category.name }}</b-col>
        <b-col class="m-1">
          <div class="float-right">
            <b-button @click="onUpdate" size="sm"><i class="fas fa-edit"></i></b-button>
            <b-button variant="danger" @click="onDelete" size="sm"><i class="fas fa-trash"></i></b-button>
          </div>
        </b-col>
      </b-row>
    </b-container>
  </b-card>
</template>

<script>
export default {
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
      console.log("delete " + this.category.id);
    },
  },
};
</script>

<style>
.bb {
  border-color: blue;
  border: solid;
  border-width: 2px;
}

.br {
  border-color: red;
  border: solid;
  border-width: 2px;
}
</style>