<template>
  <b-container>
    <h1>Test List</h1>
    <Tree :value="treeData"></Tree>
  </b-container>
</template>

<script>
import 'he-tree-vue/dist/he-tree-vue.css'
import {Tree} from 'he-tree-vue'

export default {
  components: { Tree },
  data() {
    return {
      treeData: [
        { text: "node 1" },
        { text: "node 2", children: [{ text: "node 2-1" }] },
      ],
    };
  },
};
</script>