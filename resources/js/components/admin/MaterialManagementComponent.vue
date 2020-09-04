<template>
  <div class="container">
    <h1>Gestion du matériel</h1>
    <div class="row my-3">
      <div class="col">
        <a href="#" class="btn btn-primary"><span class="fa fa-search"></span> Ajouter une catégorie</a>
        <a href="#" class="btn btn-primary">Ajouter un matériel</a>
      </div>
    </div>

    <!-- CATEGORIES -->
    <button
      class="btn btn-primary"
      type="button"
      data-toggle="collapse"
      data-target="#collapse-category"
      aria-expanded="false"
      aria-controls="collapse-category"
    >Afficher</button>
    <div class="row my-3">
      <div class="col">
        <div class="card collapse" id="collapse-category">
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
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
