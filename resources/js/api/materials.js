const { default: Axios } = require("axios")

export default {
    async getAll() {
        return axios.get('/materials');
    },
    async post(material) {
        return axios.post('/materials', material)
    },
    async filter(filters) {
        return axios.post('/materials/filter', filters)
    },
    async update(id, material) {
        return axios.post("/materials/" + id, material)
    },
    async delete(id) {
        return axios.delete('/materials/' + id)
    },

}