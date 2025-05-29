<template>
  <div>
    <h2>Nueva Sucursal</h2>
    <form @submit.prevent="save">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.address" placeholder="Dirección" />
      <button>Guardar</button>
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
  methods: {
    save() {
      axios.post('/api/branches', this.form)
        .then(() => this.$router.push('/sucursales'));
    }
  }
}
</script>
