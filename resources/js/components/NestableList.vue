<template>
  <div>
    <vue-draggable v-model="localData">
      <div class="nestable-item" v-for="element in localData" :key="element.id">
        <slot :[item]="element"></slot>
      </div>
    </vue-draggable>
  </div>
</template>

<script>
import VueDraggable from "vuedraggable";

export default {
  components: {
    VueDraggable
  },
  props: {
    data: Array,
    item: String
  },
  data() {
    return {
      localData: []
    };
  },
  methods: {
    log(message) {
      console.log(message)
    }
  },
  mounted() {
    this.localData = this.data
  },
};
</script>

<style>
.nestable-item {
  background-color: rgba(106, 127, 233, 0.274);
  border: 1px dashed rgb(73, 100, 241);
  -webkit-border-radius: 5px;
  border-radius: 5px;
}
</style>