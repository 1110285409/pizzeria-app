<template>
  <div>
    <h2>Editar Sucursal</h2>
    <form @submit.prevent="update">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.address" placeholder="Dirección" />
      <button>Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        address: ''
      }
    };
  },
  mounted() {
    axios.get(`/api/branches/${this.$route.params.id}`)
      .then(res => this.form = res.data);
  },
  methods: {
    update() {
      axios.put(`/api/branches/${this.$route.params.id}`, this.form)
        .then(() => this.$router.push('/sucursales'));
    }
  }
}
</script>
