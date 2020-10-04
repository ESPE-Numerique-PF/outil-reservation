import api from '../../api/materials'

// state
const state = () => ({
    materials: []
})

// getters
const getters = {
    materials: (state) => {
        return state.materials
    }
}

// actions
const actions = {
    createMaterials({ commit }, material) {
        api.post(material)
            .then(response => {
                commit('CREATE_MATERIAL', response.data)
            })
            .catch(error => console.log(error))
    },
    fetchMaterials({ commit }) {
        api.getAll()
            .then(response => {
                commit('FETCH_MATERIALS', response.data)
            })
            .catch(error => console.log(error))

    },
    updateMaterial({ commit }, { materialId, material }) {
        api.update(materialId, material)
            .then((response) => {
                commit('UPDATE_MATERIAL', response.data)
            })
            .catch((error) => console.log(error));
    },
    deleteMaterial({ commit }, material) {
        api.delete(material.id)
            .then(response => {
                commit('DELETE_MATERIAL', material)
                console.log(response)
            })
            .catch(error => console.log(error))
    }
}

// mutations
const mutations = {
    CREATE_MATERIAL(state, material) {
        state.materials.push(material)
    },
    FETCH_MATERIALS(state, materials) {
        return state.materials = materials
    },
    UPDATE_MATERIAL(state, material) {},
    DELETE_MATERIAL(state, material) {},
}

export default {
    state,
    getters,
    actions,
    mutations
}