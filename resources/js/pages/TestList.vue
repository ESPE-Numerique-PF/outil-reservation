<template>
  <b-container>
    <h1>Test List</h1>
    <Tree :value="treeData">
      <template v-slot="{ node, path, tree }">
        <!-- CARD -->
        <b-card no-body>
          <b-row class="justify-content-md-end pl-3 py-1">
            <!-- Fold button + Text -->
            <b-col>
              <b-button v-if="node.children && node.children.length" pill variant="light" size="sm" @click="tree.toggleFold(node, path)">
                <span :key="node.$folded ? 'right' : 'down'">
                  <i class="fas" :class="[node.$folded ? 'fa-caret-right' : 'fa-caret-down']" />
                </span>
              </b-button>
              {{ node }}
            </b-col>

            <!-- Action buttons -->
            <b-col md="auto">
              <b-button pill variant="light" size="sm">
                <i class="fas fa-plus"></i>
              </b-button>
              <b-button pill variant="light" size="sm">
                <i class="fas fa-edit"></i>
              </b-button>
              <b-button pill variant="light" size="sm">
                <i class="fas fa-trash"></i>
              </b-button>
            </b-col>
          </b-row>
        </b-card>
      </template>
    </Tree>
  </b-container>
</template>

<script>
import { Tree, Fold, Draggable } from "he-tree-vue";

export default {
  components: { Tree: Tree.mixPlugins([Fold, Draggable]) },
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


.he-tree .tree-placeholder-node{
  background: #0000001f;
  /* border: 1px dashed #00d9ff; */
  height: 20px;
}
.he-tree .dragging .tree-node-back:hover{
  background-color: inherit;
}
</style>