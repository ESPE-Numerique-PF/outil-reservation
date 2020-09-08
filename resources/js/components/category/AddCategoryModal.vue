<template>
  <div>
    <b-modal
      :id="id"
      ref="add-category-modal"
      cancel-title="Annuler"
      title="Nouvelle catégorie"
      hide-footer
    >
      <!-- ERROR ALERT -->
      <b-alert variant="danger" v-model="error.show" dismissible>{{ error.message }}</b-alert>

      <!-- FORM -->
      <b-form @submit.prevent="onSubmit">
        <b-form-group id="input-group">
          <b-form-input id="name" placeholder="Nom" v-model="form.name" required></b-form-input>
        </b-form-group>

        <b-form-group id="input-file-group">
          <b-form-file
            v-model="form.image"
            :state="Boolean(form.image)"
            placeholder="Rechercher une image ou déposer ici..."
            accept="image/*"
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
    add: Function,
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
    };
  },

  methods: {
    onSubmit(evt) {
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("image", this.form.image);
      this.add(formData, this.hideModal, this.showError);
    },
    hideModal() {
      this.resetForm();
      this.$refs["add-category-modal"].hide();
    },
    showError(error) {
      this.error.show = true;
      this.error.message = error.response.data.message;
    },
    resetForm() {
      this.form = {
        name: "",
        image: null,
      };
    },
  },
};
</script>