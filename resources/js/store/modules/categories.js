import api from '../../api/categories'

/**
 * find an item in a nested array by its id (each item must have 'id' and 'children' keys)
 * @param {*} data 
 * @param {*} id 
 */
function findById(data, id) {
    function iter(a) {
        if (a.id === id) {
            result = a;
            return true;
        }
        return Array.isArray(a.children) && a.children.some(iter);
    }

    var result;
    data.some(iter);
    return result
};

// state
const state = () => ({
    categories: []
})

// getters
const getters = {
    categories: (state) => {
        return state.categories
    }
}

// actions
const actions = {
    createCategory({ commit }, { category, path }) {
        api.post(category)
            .then(response => {
                let newCategory = response.data
                commit('CREATE_CATEGORY', { category: newCategory, path: path })
            })
            .catch(error => console.log(error))
    },
    fetchCategories({ commit }, callback) {
        api.getAll()
            .then(categories => {
                commit('FETCH_CATEGORIES', categories.data)
                    // execute callback if defined (throw an error if defined and not a function)
                if (callback) callback()
            })
            .catch(error => console.log(error))

    },
    updateCategory({ commit }, { categoryId, category }) {
        api.update(categoryId, category)
            .then((response) => {
                commit('UPDATE_CATEGORY', response.data)
            })
            .catch((error) => console.log(error));
    },
    moveCategory({ commit }, categories) {
        api.move(categories)
            .then((response) => {
                console.log(response)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    deleteCategory({ commit }, { category, path, tree }) {
        api.delete(category.id)
            .then(response => {
                commit('DELETE_CATEGORY', { path, tree })
                console.log(response)
            })
            .catch(error => console.log(error))
    }
}

// mutations
const mutations = {
    CREATE_CATEGORY(state, { category, path }) {
        if (!(path && path.length))
            state.categories.push(category)
        else {
            let parentCategory = state.categories[path.shift()]
            while (path && path.length) {
                parentCategory = parentCategory.children[path.shift()]
            }
            parentCategory.children.push(category)
        }
    },
    FETCH_CATEGORIES(state, categories) {
        return state.categories = categories
    },
    UPDATE_CATEGORY(state, category) {
        let categoryToUpdate = findById(state.categories, category.id);
        Object.assign(categoryToUpdate, category)
    },
    DELETE_CATEGORY(state, { tree, path }) {
        tree.removeNodeByPath(path);
        console.log('category deleted')
    },
}

export default {

    state,
    getters,
    actions,
    mutations
}