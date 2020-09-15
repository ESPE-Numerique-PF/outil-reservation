<template>
  <div is="draggable">
    <b-col>{{ item }}</b-col>
  </div>
</template>

<script>
export default {
  props: {
    item: Object,
  },
};
</script>