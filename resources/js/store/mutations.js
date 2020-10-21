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

let mutations = {
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
        console.log(category)
        let categoryToUpdate = findById(state.categories, category.id);
        Object.assign(categoryToUpdate, category)
    },
    DELETE_CATEGORY(state, {tree, path}) {
        tree.removeNodeByPath(path);
        console.log('category deleted')
    }
}

export default mutations