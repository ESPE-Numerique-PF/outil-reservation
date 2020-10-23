<template>
  <div>
    <b-modal
      :id="id"
      ref="update-material-modal"
      cancel-title="Annuler"
      title="Modifier le matériel"
      hide-footer
      @show="onShowModal"
    >
      <!-- ERROR ALERT -->
      <b-alert variant="danger" v-model="error.show" dismissible>{{ error.message }}</b-alert>

      <div class="mb-3 preview">
        <b-img class="preview-img" v-if="imageUrl" :src="imageUrl" rounded></b-img>
      </div>

      <!-- FORM -->
      <b-form @submit.prevent="onSubmit">
        <!-- Name -->
        <b-form-group label="Nom" label-cols="3">
          <b-form-input id="name" placeholder="Nom" v-model="form.name" required autofocus></b-form-input>
        </b-form-group>

        <!-- Description -->
        <b-form-group label="Description" label-cols="3">
          <b-form-textarea id="description" placeholder="Description" v-model="form.description"></b-form-textarea>
        </b-form-group>

        <!-- Note -->
        <b-form-group label="Note" label-cols="3">
          <b-form-textarea id="note" placeholder="Note" v-model="form.note"></b-form-textarea>
        </b-form-group>

        <!-- Category -->
        <b-form-group label="Catégorie" label-cols="3">
          <treeselect placeholder="Choisissez une catégorie" v-model="form.categoryId" :options="categories">
            <template v-slot:option-label="{node}">{{ node.raw.name }}</template>
            <template v-slot:value-label="{node}">{{ node.raw.name }}</template>
          </treeselect>
        </b-form-group>

        <!-- Image -->
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
    </b-modal>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import Treeselect from "@riophae/vue-treeselect";
import "@riophae/vue-treeselect/dist/vue-treeselect.css";

export default {
  components: {
    Treeselect,
  },
  props: {
    material: Object,
    id: String,
  },
  data() {
    return {
      form: {
        name: this.material.name,
        description: this.material.description,
        note: this.material.note,
        image: null,
        imageHasChanged: false,
        categoryId: this.material.category_id,
      },
      error: {
        message: "",
        show: false,
      },
      imageUrl: null,
    };
  },

  computed: {
    ...mapGetters({
      categories: "categories",
    }),
  },

  methods: {
    ...mapActions({
      fetchCategories: "fetchCategories",
    }),
    onSubmit(evt) {
      let formData = new FormData();
      formData.append("_method", "PUT");
      formData.append("name", this.form.name);
      if (this.form.description !== null) formData.append("description", this.form.description);
      if (this.form.note !== null) formData.append("note", this.form.note);
      formData.append("imageHasChanged", this.form.imageHasChanged);
      if (this.form.image !== null) formData.append("image", this.form.image);
      if (this.form.categoryId != null) formData.append("categoryId", this.form.categoryId);

      this.$store
        .dispatch("updateMaterial", {
          materialId: this.material.id,
          material: formData,
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
      this.$refs["update-material-modal"].hide();
    },
    showError(error) {
      this.error.show = true;
      this.error.message = error.response.data.message;
    },
    onShowModal() {
      this.form.name = this.material.name;
      this.imageUrl = this.material.image_URI;
    },
    reset() {
      this.error = {
        message: "",
        show: false,
      };
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>

<style>
.preview {
  display: flex;
  justify-content: center;
  align-content: center;
}

.preview-img {
  max-width: 100%;
  max-height: 256px;
}
</style>