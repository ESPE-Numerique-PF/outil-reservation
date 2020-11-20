<template>
  <b-container class="py-3">
    
    <h1>Test</h1>

    <b-row>

    </b-row>

  </b-container>
</template>

<script>
export default {
  mounted() {
    let s = document.createElement('script');
    s.setAttribute('src', 'https://www.google.com/recaptcha/api.js');

    document.head.appendChild(document.createComment('--- SCRIPT FROM TestComponent.vue ---'));
    document.head.appendChild(s);
  }
};
</script>

<style>
</style>
