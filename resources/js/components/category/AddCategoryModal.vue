<template>
  <div>
    <b-modal 
      :id="id"
      ref="add-category-modal"
      cancel-title="Annuler" 
      title="Nouvelle catégorie"
      hide-footer
      >
      <!-- FORM -->
      <b-form @submit="onSubmit">
          <b-form-input id="name" placeholder="Nom" v-model="form.name" required></b-form-input>

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
    id: String
  },
  
  data() {
    return {
      form: {
        name: ''
      },
      show: true
    }
  },

  methods: {
    onSubmit(evt) {
      evt.preventDefault()
      this.addCategory()
    },
    hideModal() {
      this.resetForm()
      this.$refs["add-category-modal"].hide()
    },
    resetForm() {
      this.form = {
        name: ''
      }
    },

    addCategory() {
      axios.post('/categories', this.form)
        .then(response => console.log(response.data))
        .catch(error => console.error(error))
    }
  }
};
</script>