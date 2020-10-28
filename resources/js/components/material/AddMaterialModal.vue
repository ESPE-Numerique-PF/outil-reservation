<template>
  <div>
    <b-modal
      :id="id"
      ref="add-material-modal"
      cancel-title="Annuler"
      title="Ajouter un matériel"
      hide-footer
      size="xl"
    >
      <b-form @submit.prevent="onSubmit">
        <!-- ERROR ALERT -->
        <b-row>
          <b-alert variant="danger" v-model="error.show" dismissible>{{ error.message }}</b-alert>
        </b-row>

        <b-row>
          <!-- Preview image -->
          <b-col cols="3">
            <div id="preview" class="mb-3">
              <b-img v-if="imageUrl" :src="imageUrl" rounded fluid />
            </div>
          </b-col>

          <!-- FORM -->
          <b-col>
            <!-- Name -->
            <b-form-group label-cols="3" label-class="form-label">
              <template #label>
                Nom
                <span class="required" />
              </template>
              <b-form-input id="name" placeholder="Nom" v-model="form.name" required autofocus></b-form-input>
            </b-form-group>

            <!-- Description -->
            <!-- <b-form-group label="Description" label-cols="3">
              <b-form-textarea
                id="description"
                placeholder="Description"
                v-model="form.description"
              ></b-form-textarea>
            </b-form-group>-->

            <!-- Note -->
            <b-form-group label="Note" label-cols="3" label-class="form-label">
              <b-form-textarea id="note" placeholder="Note" v-model="form.note"></b-form-textarea>
            </b-form-group>

            <!-- Category -->
            <b-form-group label="Catégorie" label-cols="3" label-class="form-label">
              <treeselect
                placeholder="Choisissez une catégorie"
                v-model="form.categoryId"
                :options="categories"
                :searchable="true"
                :normalizer="normalizer"
              >
                <template v-slot:option-label="{ node }">
                  {{
                  node.raw.name
                  }}
                </template>
                <template v-slot:value-label="{ node }">
                  {{
                  node.raw.name
                  }}
                </template>
              </treeselect>
            </b-form-group>

            <!-- Image -->
            <b-form-group label-class="form-label">
              <b-form-file
                v-model="form.image"
                :state="Boolean(form.image)"
                placeholder="Rechercher une image ou déposer ici..."
                accept="image/*"
                @change="onFileChange"
              ></b-form-file>
            </b-form-group>
          </b-col>
        </b-row>

        <!-- Description -->
        <b-row>
          <b-form-group label="Description" class="m-3" label-class="form-label">
            <vueditor ref="editor"></vueditor>
          </b-form-group>
        </b-row>

        <!-- Buttons -->
        <b-row class="justify-content-end">
          <b-col cols="auto">
            <b-button type="submit" variant="primary">Ajouter</b-button>
            <b-button @click="hideModal" variant="danger">Annuler</b-button>
          </b-col>
        </b-row>
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
    id: String,
  },

  data() {
    return {
      form: {
        name: "",
        note: "",
        image: null,
        categoryId: null,
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
    normalizer(node) {
      return {
        id: node.id,
        label: node.name,
        children: node.children,
      };
    },
    onSubmit(evt) {
      // get vueditor content
      let editor = this.$refs['editor'];
      let description = editor.getContent();

      // build formdata and send to server
      let formData = new FormData();
      formData.append("name", this.form.name);
      formData.append("description", description);
      formData.append("note", this.form.note);
      if (this.form.categoryId != null)
        formData.append("categoryId", this.form.categoryId);
      if (this.form.image !== null) formData.append("image", this.form.image);

      this.$store
        .dispatch("createMaterial", { material: formData })
        .then((response) => this.hideModal())
        .catch((error) => console.log("error"));
    },
    onFileChange(evt) {
      const file = evt.target.files[0];
      this.imageUrl = URL.createObjectURL(file);
    },
    hideModal() {
      this.reset();
      this.$refs["add-material-modal"].hide();
    },
    showError(error) {
      this.error.show = true;
      this.error.message = error.response.data.message;
    },
    reset() {
      this.form = {
        name: "",
        note: "",
        image: null,
        categoryId: null,
      };
      this.error = {
        message: "",
        show: false,
      };
      this.imageUrl = null;
    },
  },
  mounted() {
    this.fetchCategories();
  },
};
</script>