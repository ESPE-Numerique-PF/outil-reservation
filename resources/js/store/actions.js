const { default: Axios } = require("axios")

let actions = {
    createCategory({ commit }, category) {
        commit('CREATE_CATEGORY', category)
        // axios.post('/categories', category)
        //     .then(response => {
        //         commit('CREATE_CATEGORY', response.data)
        //     })
        //     .catch(error => console.log(error))
    },
    fetchCategories({ commit }) {
        let categories = [
            { id: 1, name: 'Informatique'},
            { id: 2, name: 'Ordinateur'},
            { id: 3, name: 'Tablette'},
        ]
        commit('FETCH_CATEGORIES', categories)
        // axios.get('/categories')
        //     .then(response => {
        //         commit('FETCH_CATEGORIES', response.data)
        //     })
        //     .catch(error => console.log(error))
    },
    deleteCategory({commit}, category) {
        commit('DELETE_CATEGORY', category)
    //     axios.delete('/categories/' + id)
    //         .then(response => {
    //             commit('FETCH_CATEGORIES', response.data)
    //         })
    //         .catch(error => console.log(error))
    }
}

export default actions