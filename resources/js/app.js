/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('@fortawesome/fontawesome-free/js/all.js');


import BootstrapVue from 'bootstrap-vue'
import Vueditor from 'vueditor' // text editor component for textarea input
import 'vueditor/dist/style/vueditor.min.css';

window.Vue = require('vue');

/**
 * Register components
 */
Vue.use(BootstrapVue);

// Vueditor config
let vueditorConfig = {
    toolbar: [
        'removeFormat', 'undo', '|', 'elements', 'fontName', 'fontSize', 'foreColor', 'backColor'
    ],
    fontName: [
        { val: 'arial black' },
        { val: 'times new roman' },
        { val: 'Courier New' }
    ],
    fontSize: ['12px', '14px', '16px', '18px', '0.8rem', '1.0rem', '1.2rem', '1.5rem', '2.0rem'],
    uploadUrl: ''
};

Vue.use(Vueditor);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// public views
Vue.component('material-list-component', require('./pages/MaterialListComponent.vue').default);

// admin views
Vue.component('admin-category-management-component', require('./pages/admin/CategoryManagementComponent.vue').default);
Vue.component('admin-material-management-component', require('./pages/admin/MaterialManagementComponent.vue').default);
Vue.component('admin-test-component', require('./pages/admin/TestComponent.vue').default);

/**
 * Import Vuex store
 */
import store from './store/index'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});