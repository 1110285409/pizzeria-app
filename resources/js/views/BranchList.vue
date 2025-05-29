<template>
  <div>
    <h2>Sucursales</h2>
    <router-link to="/sucursales/nueva">Nueva Sucursal</router-link>
    <ul>
      <li v-for="branch in branches" :key="branch.id">
        {{ branch.name }} – {{ branch.address }}
        <router-link :to="`/sucursales/${branch.id}/editar`">Editar</router-link>
        <button @click="remove(branch.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { branches: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/branches')
        .then(res => this.branches = res.data);
    },
    remove(id) {
      if (confirm('¿Eliminar sucursal?')) {
        axios.delete(`/api/branches/${id}`)
          .then(() => this.load());
      }
    }
  }
}
</script>
