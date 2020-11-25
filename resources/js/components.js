import Vue from 'vue'

// public views
Vue.component('material-list-component', require('@/pages/MaterialListComponent.vue').default);
Vue.component('booking-component', require('@/pages/BookingComponent.vue').default);

// admin views
Vue.component('admin-resource-management-component', require('@/pages/admin/ResourceManagementComponent.vue').default);

Vue.component('admin-category-management-component', require('@/pages/admin/CategoryManagementComponent.vue').default);
Vue.component('admin-material-management-component', require('@/pages/admin/MaterialManagementComponent.vue').default);
Vue.component('admin-material-instance-management-component', require('@/pages/admin/MaterialInstanceManagementComponent.vue').default);

Vue.component('admin-test-component', require('@/pages/admin/TestComponent.vue').default);
Vue.component('admin-info-component', require('@/pages/admin/InfoComponent.vue').default);
