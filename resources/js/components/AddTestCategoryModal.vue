<template>
  <div>
    <b-modal
      :id="id"
      ref="add-category-modal"
      cancel-title="Annuler"
      title="Créer une catégorie"
      hide-footer
    >
      <!-- FORM -->
      <b-form @submit.prevent="onSubmit">
        <b-form-group id="input-group">
          <b-form-input
            id="name"
            placeholder="Nom"
            v-model="form.name"
            required
            autofocus
          ></b-form-input>
        </b-form-group>

        <!-- SUBMIT BUTTONS -->
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
  },
  data() {
    return {
      form: {
        name: "",
      },
    };
  },
  methods: {
    onSubmit(evt) {
      this.$store.dispatch('createCategory', this.form)
    },
    hideModal() {
      this.clean();
      this.$ref['add-category-modal'].hide();
    },
    clean() {
      this.form = {
        name:''
      }
    }
  },
};
</script>