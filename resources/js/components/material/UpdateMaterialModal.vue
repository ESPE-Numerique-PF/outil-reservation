<template>
  <div>
    <b-modal
      :id="id"
      ref="update-material-modal"
      cancel-title="Annuler"
      title="Modifier le matériel"
      hide-footer
      @show="onShowModal"
      size="xl"
    >
      <!-- FORM -->
      <b-form @submit.prevent="onSubmit">
        <!-- ERROR ALERT -->
        <b-row>
          <b-alert variant="danger" v-model="error.show" dismissible>
            {{
            error.message
            }}
          </b-alert>
        </b-row>

        <b-row>
          <!-- Preview image -->
          <b-col cols="3">
            <div class="mb-3 preview">
              <b-img v-if="imageUrl" :src="imageUrl" rounded fluid></b-img>
            </div>
          </b-col>

          <!-- FORM -->
          <b-col>
            <!-- Name -->
            <b-form-group label-cols="3">
              <template #label>
                Nom
                <span class="required" />
              </template>
              <b-form-input id="name" placeholder="Nom" v-model="form.name" required autofocus></b-form-input>
            </b-form-group>

            <!-- Note -->
            <b-form-group label="Note" label-cols="3">
              <b-form-textarea id="note" placeholder="Note" v-model="form.note"></b-form-textarea>
            </b-form-group>

            <!-- Category -->
            <b-form-group label="Catégorie" label-cols="3">
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
            <b-form-group id="input-file-group">
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
            <!-- TODO -->
            <vue-editor v-model="form.description"></vue-editor>
          </b-form-group>
        </b-row>

        <!-- Buttons -->
        <b-row class="justify-content-end">
          <b-col cols="auto">
            <b-button type="submit" variant="primary">Modifier</b-button>
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
import { VueEditor } from "vue2-editor";

export default {
  components: {
    Treeselect,
    VueEditor,
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
    normalizer(node) {
      return {
        id: node.id,
        label: node.name,
        children: node.children,
      };
    },
    onSubmit(evt) {
      let formData = new FormData();
      formData.append("_method", "PUT");
      formData.append("name", this.form.name);
      if (this.form.description !== null)
        formData.append("description", this.form.description);
      if (this.form.note !== null) formData.append("note", this.form.note);
      formData.append("imageHasChanged", this.form.imageHasChanged);
      if (this.form.image !== null) formData.append("image", this.form.image);
      if (this.form.categoryId != null)
        formData.append("categoryId", this.form.categoryId);

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