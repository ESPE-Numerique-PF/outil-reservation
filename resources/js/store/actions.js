const { default: Axios } = require("axios")

let actions = {
    createCategory({ commit }, { category, path }) {
        axios.post('/categories', category)
            .then(response => {
                let newCategory = response.data
                commit('CREATE_CATEGORY', { category: newCategory, path: path })
            })
            .catch(error => console.log(error))
    },
    fetchCategories({ commit }, callback) {
        axios.get('/categories')
            .then(response => {
                commit('FETCH_CATEGORIES', response.data)
                // execute callback if defined (throw an error if defined and not a function)
                if (callback) callback()
            })
            .catch(error => console.log(error))

    },
    updateCategory({ commit }, { categoryId, category }) {
        axios
            .post("/categories/" + categoryId, category)
            .then((response) => {
                commit('UPDATE_CATEGORY', response.data)
            })
            .catch((error) => console.log(error));
    },
    moveCategory({ commit }, categories) {
        axios
            .post("/categories/move", { categories: categories })
            .then((response) => {
                console.log(response)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    deleteCategory({ commit }, { category, path, tree }) {
        axios.delete('/categories/' + category.id)
            .then(response => {
                commit('DELETE_CATEGORY', { path, tree })
                console.log(response)
            })
            .catch(error => console.log(error))
    }
}

export default actions