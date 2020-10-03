const { default: Axios } = require("axios")

export default {
    async getAll() {
        return axios.get('/categories')
    },
    async post(category) {
        return axios.post('/categories', category)
    },
    async update(id, category) {
        return axios.post("/categories/" + id, category)
    },
    async delete(id) {
        return axios.delete('/categories/' + id)
    },
    async move(categories) {
        return axios.post("/categories/move", { categories: categories })
    },

}