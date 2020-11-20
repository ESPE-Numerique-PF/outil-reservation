<template>
  <b-container class="py-3">

    <h1>Informations serveur</h1>
    
    <table id="info-table" class="table table-bordered bg-white">
      <tr v-for="(item, key) in info" :key="key">
        <th scoped="row">{{ key }}</th>
        <td>{{ item }}</td>
      </tr>
    </table>
    
  </b-container>
</template>

<script>
export default {
  data() {
    return {
      info: {}
    };
  },
  methods: {
    getInfo() {
      axios.get('info')
        .then(response => this.info = Object.assign({}, response.data, this.info))
        .catch(error => console.log(error));
    }
  },
  mounted() {
    this.getInfo();
    this.info['VueJS'] = Vue.version;
  }
};
</script>

<style>

#info-table th {
  background: lightgrey;
}

</style>