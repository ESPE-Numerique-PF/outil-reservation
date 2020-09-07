<template>
  <div class="container">
    <h1>Matériel</h1>
    <!-- CATEGORIES -->
    <div class="row my-3">
      <div class="col">
        <div class="card">
          <div class="card-header">Catégories de matériel</div>

          <div class="card-body">
            <ul>
              <li v-for="category in categories" :key="category.id">
                {{ category.name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- MATERIALS -->
    <div class="row my-3">
      <div class="col">
        <div class="card">
          <div class="card-header">Matériel</div>

          <div class="card-body">
            <ul>
              <li>Matériel 1</li>
              <li>Matériel 2</li>
              <li>Matériel 3</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      categories: []
    }
  },
  mounted() {
    axios.get('http://localhost/outil-reservation/resources/categories')
      .then(response => this.categories = response.data)
      .catch(error => console.log(error))
  },
};
</script>
