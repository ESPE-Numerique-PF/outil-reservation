<template>
  <div class="editor">
    <vue-editor :value="value" @input="update" :editorToolbar="toolbar" />
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor,
  },
  props: ["value"],
  data() {
    return {
      toolbar: [
        [{ header: [false, 1, 2, 3] }],
        ["bold", "italic", "underline", "strike"],
        [
          { align: "" },
          { align: "center" },
          { align: "right" },
          { align: "justify" },
        ],
        [{ list: "ordered" }, { list: "bullet" }],
      ],
    };
  },
  methods: {
    update(value) {
      this.$emit("input", value);
    },
  },
};
</script>