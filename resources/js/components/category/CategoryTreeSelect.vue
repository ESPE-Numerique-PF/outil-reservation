<template>
  <div>
    <treeselect
      :value="value"
      @input="update"
      :placeholder="placeholder"
      :options="options"
      :searchable="true"
      :normalizer="normalizer"
      :multiple="true"
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
  </div>
</template>

<script>
import Treeselect from "@riophae/vue-treeselect";
import "@riophae/vue-treeselect/dist/vue-treeselect.css";

export default {
  components: {
    Treeselect,
  },
  props: {
    placeholder: {
      type: String,
      default: "Toutes les catégories",
    },
    searchable: {
      type: Boolean,
      default: true,
    },
    options: Array,
    value: Array,
  },
  data() {
    return {};
  },
  methods: {
    update(value) {
      this.$emit("input", value);
    },
    /**
     * Specify to TreeSelect component what are the names used for the id, 
     * the label and the children fields for each element.
     * 
     * @param node the object element
     */
    normalizer(node) {
      return {
        id: node.id,
        label: node.name,
        children: node.children,
      };
    },
  },
};
</script>