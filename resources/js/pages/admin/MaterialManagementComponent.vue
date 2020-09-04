<template>
  <div class="container">
    <h1>Gestion du matériel</h1>
    <div class="row my-3">
      <div class="col">
        <a href="#" class="btn btn-primary">
          <span class="fas fa-plus"></span> Ajouter une catégorie
        </a>
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
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
