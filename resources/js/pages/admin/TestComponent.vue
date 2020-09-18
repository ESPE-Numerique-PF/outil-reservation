<template>
  <b-container>
    <h1>Test</h1>

    <tree v-model="treeData" :foldAllAfterMounted="true">
      <span slot-scope="{node, index, path, tree}">
        <b @click="tree.toggleFold(node, path)">{{node.$folded ? '+' : '-'}}</b>
        {{node.text}}
      </span>
    </tree>
  </b-container>
</template>

<script>
import { Tree, Fold, Draggable, foldAll } from "he-tree-vue";

export default {
  components: {
    Tree: Tree.mixPlugins([Fold, Draggable]),
  },
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

<style>
.he-tree--hidden{
  display: none;
}
.he-tree--rtl{
  direction: rtl;
}


/* .he-tree .tree-placeholder{
} */
.he-tree .tree-placeholder-node{
  background: #0000001c;
  height: 50px;
}
.he-tree .dragging .tree-node-back:hover{
  background-color: inherit;
}

.item-draggable {
  cursor: grab;
}
</style>