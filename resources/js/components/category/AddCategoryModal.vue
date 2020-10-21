<template>
  <div>
    <b-modal
      :id="id"
      ref="add-category-modal"
      cancel-title="Annuler"
      title="Créer une catégorie"
      hide-footer
    >
      <!-- ERROR ALERT -->
      <b-alert variant="danger" v-model="error.show" dismissible>{{ error.message }}</b-alert>

      <h4 v-if="node !== undefined">
        <b-badge pill variant="light" class="px-3 mb-3">{{ node.name }}</b-badge>
      </h4>

      <div id="preview" class="mb-3">
        <b-img v-if="imageUrl" :src="imageUrl" rounded></b-img>
      </div>

      <!-- FORM -->
      <b-form @submit.prevent="onSubmit">
        <b-form-group id="input-group">
          <b-form-input id="name" placeholder="Nom" v-model="form.name" required autofocus></b-form-input>
        </b-form-group>

        <b-form-group id="input-file-group">
          <b-form-file
            v-model="form.image"
            :state="Boolean(form.image)"
            placeholder="Rechercher une image ou déposer ici..."
            accept="image/*"
            @change="onFileChange"
          ></b-form-file>
        </b-form-group>

        <!-- Buttons -->
        <b-button type="submit" variant="primary">Ajouter</b-button>
        <b-button @click="hideModal" variant="danger">Annuler</b-button>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {
    id: String,
    node: Object,
    path: Array
  },

  data() {
    return {
      form: {
        name: "",
        image: null,
      },
      error: {
        message: "",
        show: false,
      },
      imageUrl: null,
    };
  },

  methods: {
    onSubmit(evt) {
      let formData = new FormData();
      formData.append("name", this.form.name);
      if (this.form.image !== null) formData.append("image", this.form.image);
      if (this.node !== undefined)
        formData.append("parent_category_id", this.node.id);
      
      this.$store.dispatch('createCategory', {category: formData, path: this.path})
        .then((response) => this.hideModal())
        .catch((error) => console.log('error'))
    },
    onFileChange(evt) {
      const file = evt.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
    },
    hideModal() {
      this.reset();
      this.$refs["add-category-modal"].hide();
    },
    showError(error) {
      this.error.show = true;
      this.error.message = error.response.data.message;
    },
    reset() {
      this.form = {
        name: "",
        image: null,
      };
      this.error = {
        message: "",
        show: false,
      };
      this.imageUrl = null;
    },
  },
};
</script>

<style>
#preview {
  display: flex;
  justify-content: center;
  align-content: center;
}

#preview b-img {
  max-width: 100%;
  max-height: 256px;
}
</style>