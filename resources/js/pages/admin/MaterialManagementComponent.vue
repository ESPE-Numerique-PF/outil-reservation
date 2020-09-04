<template>
  <div class="container">
    <h1>Gestion du matériel</h1>
    <div class="row">
      User: {{ userId }}
    </div>
    <div class="row my-3">
      <div class="col">
        <button class="btn btn-primary" v-on:click="addCategory">
          <span class="fas fa-plus"></span> Ajouter une catégorie
        </button>
      </div>
    </div>

    <!-- CATEGORIES -->
    <div class="row my-3">
      <div class="col">
        <div class="card">
          <div class="card-header">Catégories de matériel</div>

          <div class="card-body">
            <ul>
              <li>Catégorie 1</li>
              <li>Catégorie 2</li>
              <li>Catégorie 3</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['userId'],
  
  methods: {
    addCategory() {
      axios.post('/outil-reservation/api/categories')
        .then(response => console.log(response))
        .catch(error => console.error(error))
    }
  },
  
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
