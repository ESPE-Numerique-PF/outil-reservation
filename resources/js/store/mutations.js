let mutations = {
    CREATE_CATEGORY(state, category) {
        state.categories.push(category)
    },
    FETCH_CATEGORIES(state, categories) {
        return state.categories = categories
    },
    DELETE_CATEGORY(state, category) {
        let index = state.categories.findIndex(item => item.id === category.id)
        state.categories.splice(index, 1)
    }
}

export default mutations