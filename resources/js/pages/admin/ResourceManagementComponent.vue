<template>
  <b-container fluid class="px-0">
    <b-tabs
      id="resource-tabs"
      active-nav-item-class="resource-active-nav-item"
      nav-class="nav-class"
      nav-wrapper-class="nav-wrapper-class"
      no-nav-style
    >
      <b-tab active lazy>
        <template #title>
          <i class="fas fa-project-diagram icon"></i> Catégories
        </template>
        <admin-category-management-component />
      </b-tab>

      <b-tab lazy>
        <template #title>
          <i class="fas fa-box icon"></i> Matériel
        </template>
        <admin-material-management-component />
      </b-tab>

      <b-tab lazy>
        <template #title>
          <i class="fas fa-boxes icon"></i> Instances
        </template>
        <admin-material-instance-management-component />
      </b-tab>
    </b-tabs>
  </b-container>
</template>

<script>
export default {};
</script>


<style lang="scss">
/**
 * Tab styling
 */

#resource-tabs {
  .nav-wrapper-class {
    padding-top: 1rem;
    // background: red;
    box-shadow: inset 0 -1px 0 #eaecef;
    a {
      color: #24292e;
      .icon {
        margin-right: 0.25rem;
        color: #666666;
      }

      &:hover {
      }
    }
    .resource-active-nav-item {
      font-weight: bold;
      font-size: 1rem;
    }
  }
}
</style>