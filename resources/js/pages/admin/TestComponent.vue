<template>
  <b-container>
    <pre>{{ categories }}</pre>
  </b-container>
</template>

<script>

export default {
  data() {
    return {
      categories: [],
    }
  },

  mounted() {
    axios.get('/categories')
      .then(response => this.categories = response.data)
      .catch(error => console.log(error))
  }
};
</script>
