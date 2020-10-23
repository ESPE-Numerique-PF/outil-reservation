<template>
  <div>
    <b-modal
      :id="id"
      ref="update-category-modal"
      cancel-title="Annuler"
      title="Modifier la catégorie"
      hide-footer
      @show="onShowModal"
      size="lg"
    >
      <!-- ERROR ALERT -->
      <b-row>
        <b-alert variant="danger" v-model="error.show" dismissible>{{ error.message }}</b-alert>
      </b-row>

      <!-- Show parent category if it exists -->
      <!-- <b-row>
        <h4 v-if="category.parent != null">
          <b-badge pill variant="light" class="px-3 mb-3">{{ category.parent.name }}</b-badge>
        </h4>
      </b-row> -->

      <b-row>
        <!-- Image preview -->
        <b-col cols="3">
          <div class="mb-3 preview">
            <b-img class="preview-img" v-if="imageUrl" :src="imageUrl" rounded fluid></b-img>
          </div>
        </b-col>

        <!-- FORM -->
        <b-col>
          <b-form @submit.prevent="onSubmit">
            <b-form-group id="input-group" label-cols="3">
              <template #label>Nom<span class="required"/></template>
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
            <b-button type="submit" variant="primary">Modifier</b-button>
            <b-button @click="hideModal" variant="danger">Annuler</b-button>
          </b-form>
        </b-col>
      </b-row>
    </b-modal>
  </div>
</template>

<script>
export default {
  props: {  
    category: Object,
    id: String,
  },
  data() {
    return {
      form: {
        name: this.category.name,
        image: null,
        imageHasChanged: false,
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
      formData.append("_method", "PUT");
      formData.append("name", this.form.name);
      formData.append("imageHasChanged", this.form.imageHasChanged);
      if (this.form.image !== null) formData.append("image", this.form.image);

      this.$store
        .dispatch("updateCategory", {
          categoryId: this.category.id,
          category: formData,
        })
        .then((response) => this.hideModal())
        .catch((error) => console.log(error));
    },
    onFileChange(evt) {
      const file = evt.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
      this.form.imageHasChanged = true;
    },
    hideModal() {
      this.reset();
      this.$refs["update-category-modal"].hide();
    },
    showError(error) {
      this.error.show = true;
      this.error.message = error.response.data.message;
    },
    onShowModal() {
      this.form.name = this.category.name;
      this.imageUrl = this.category.image_URI;
    },
    reset() {
      this.error = {
        message: "",
        show: false,
      };
    },
  },
};
</script>