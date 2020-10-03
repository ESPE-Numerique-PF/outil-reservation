/**
 * Main store file that assemble modules and export the store
 */

import Vue from 'vue'
import Vuex from 'vuex'
import categories from './modules/categories'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        categories
    }
});