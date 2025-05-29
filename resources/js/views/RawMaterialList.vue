<template>
  <div>
    <h2>Materias Primas</h2>
    <router-link to="/materias/nueva">Nueva Materia Prima</router-link>
    <ul>
      <li v-for="material in materials" :key="material.id">
        {{ material.name }} – {{ material.current_stock }} {{ material.unit }}
        <router-link :to="`/materias/${material.id}/editar`">Editar</router-link>
        <button @click="remove(material.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { materials: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/raw-materials')
        .then(res => this.materials = res.data);
    },
    remove(id) {
      if (confirm('¿Eliminar materia prima?')) {
        axios.delete(`/api/raw-materials/${id}`)
          .then(() => this.load());
      }
    }
  }
};
</script>
