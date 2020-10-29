<template>
  <div>
    <vue-editor :value="value" @input="update" />
    <!-- <b-form-textarea :value="value" @input="update($event.target.value)"></b-form-textarea> -->
    <!-- <b-form-textarea v-model="value" /> -->
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor,
  },
  props: ["value"],
  methods: {
    update(value) {
      this.$emit("input", value);
    },
  },
};
</script>