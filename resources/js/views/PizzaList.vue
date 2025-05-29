<template>
  <div>
    <h2>Pizzas</h2>
    <router-link to="/pizzas/nueva">Nueva Pizza</router-link>
    <ul>
      <li v-for="pizza in pizzas" :key="pizza.id">
        {{ pizza.name }}
        <ul>
          <li v-for="size in pizza.sizes" :key="size.id">
            {{ size.size }} - ${{ size.price }}
          </li>
        </ul>
        <router-link :to="`/pizzas/${pizza.id}/editar`">Editar</router-link>
        <button @click="remove(pizza.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { pizzas: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/pizzas').then(res => this.pizzas = res.data);
    },
    remove(id) {
      if (confirm('¿Eliminar pizza?')) {
        axios.delete(`/api/pizzas/${id}`).then(() => this.load());
      }
    }
  }
}
</script>
