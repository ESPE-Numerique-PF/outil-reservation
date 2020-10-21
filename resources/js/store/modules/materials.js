import materials from '../../api/materials'
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
    createMaterial({ commit }, { material }) {
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
    UPDATE_MATERIAL(state, material) { 
        // TODO
        let materialToUpdate = state.materials.find(element => element.id === material.id)
        Object.assign(materialToUpdate, material)
    },
    DELETE_MATERIAL(state, material) {
        // TODO
        let materialIndexToRemove = state.materials.findIndex(element => element.id === material.id)
        if (materialIndexToRemove > -1)
            state.materials.splice(materialIndexToRemove, 1)
            
        // TODO remove all material instances attached to this material
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}