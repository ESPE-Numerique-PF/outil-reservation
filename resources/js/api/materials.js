const { default: Axios } = require("axios")

export default {
    async getAll() {
        return axios.get('/materials')
    },
    async post(material) {
        return axios.post('/materials', material)
    },
    // async update(id, category) {
    //     return axios.post("/materials/" + id, category)
    // },
    async delete(id) {
        return axios.delete('/materials/' + id)
    },

}