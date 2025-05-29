<template>
  <div>
    <h2>Ingredientes</h2>
    <router-link to="/ingredientes/nuevo">Nuevo Ingrediente</router-link>
    <ul>
      <li v-for="item in ingredients" :key="item.id">
        {{ item.name }}
        <router-link :to="`/ingredientes/${item.id}/editar`">Editar</router-link>
        <button @click="remove(item.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { ingredients: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/ingredients').then(res => this.ingredients = res.data);
    },
    remove(id) {
      if (confirm('¿Eliminar ingrediente?')) {
        axios.delete(`/api/ingredients/${id}`).then(() => this.load());
      }
    }
  }
}
</script>
