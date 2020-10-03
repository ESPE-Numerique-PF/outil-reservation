<script>
import { Tree, Fold, Draggable, walkTreeDatan } from "he-tree-vue";

export default {
  extends: Tree,
  mixins: [Fold, Draggable],
  props: {
    dataFetchedAfterMounted: Boolean,
  },
  computed: {
    // get all id of folded nodes
    foldedNodesById: function () {
      let foldedNodes = [];

      walkTreeData(this.treeData, (node, index, parent, path) => {
        if (node.$folded) foldedNodes.push(node.id);
      });

      return foldedNodes;
    },
  },
  watch: {
    dataFetchedAfterMounted: function () {
      if (this.dataFetchedAfterMounted && this.foldAllAfterMounted) {
        this.foldAll();
      }
    },
  },
};
</script>

<style>
.he-tree--hidden {
  display: none;
}
.he-tree--rtl {
  direction: rtl;
}

/* .he-tree .tree-placeholder{
} */
.he-tree .tree-placeholder-node {
  background: #0000001c;
  height: 50px;
}
.he-tree .dragging .tree-node-back:hover {
  background-color: inherit;
}

.item-draggable {
  cursor: grab;
}
</style>