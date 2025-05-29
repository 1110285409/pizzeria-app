<template>
  <div>
    <h2>Pedidos</h2>
    <router-link to="/pedidos/nuevo">Nuevo Pedido</router-link>
    <ul>
      <li v-for="order in orders" :key="order.id">
        Pedido #{{ order.id }} – Cliente: {{ order.client.user.name }} – ${{ order.total_price }}
        <ul>
          <li v-for="pizza in order.pizzas" :key="pizza.id">
            {{ pizza.pizza.name }} ({{ pizza.size }}) × {{ pizza.pivot.quantity }}
          </li>
          <li v-for="extra in order.extra_ingredients" :key="extra.id">
            Extra: {{ extra.name }} × {{ extra.pivot.quantity }}
          </li>
        </ul>
        <button @click="remove(order.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { orders: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/orders').then(res => this.orders = res.data);
    },
    remove(id) {
      if (confirm('¿Eliminar pedido?')) {
        axios.delete(`/api/orders/${id}`).then(() => this.load());
      }
    }
  }
};
</script>
