<template>
  <div>
    <h2>Nuevo Pedido</h2>
    <form @submit.prevent="submit">
      <select v-model="form.client_id" required>
        <option v-for="c in clients" :value="c.id" :key="c.id">{{ c.user.name }}</option>
      </select>

      <select v-model="form.delivery_type" required>
        <option value="en_local">En local</option>
        <option value="a_domicilio">A domicilio</option>
      </select>

      <div v-if="form.delivery_type === 'a_domicilio'">
        <select v-model="form.delivery_person_id">
          <option v-for="e in employees" :value="e.id" :key="e.id">{{ e.user.name }}</option>
        </select>
      </div>

      <h3>Pizzas</h3>
      <div v-for="(p, i) in form.pizzas" :key="i">
        <select v-model="p.pizza_size_id">
          <option v-for="ps in pizzaSizes" :value="ps.id" :key="ps.id">
            {{ ps.pizza.name }} - {{ ps.size }} (${{ ps.price }})
          </option>
        </select>
        <input type="number" v-model="p.quantity" placeholder="Cantidad" min="1" />
      </div>
      <button type="button" @click="addPizza">+ Pizza</button>

      <h3>Extras</h3>
      <div v-for="(e, i) in form.extras" :key="i">
        <select v-model="e.extra_ingredient_id">
          <option v-for="ex in extras" :value="ex.id" :key="ex.id">{{ ex.name }}</option>
        </select>
        <input type="number" v-model="e.quantity" placeholder="Cantidad" min="1" />
      </div>
      <button type="button" @click="addExtra">+ Extra</button>

      <button type="submit">Guardar Pedido</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      clients: [],
      pizzaSizes: [],
      extras: [],
      employees: [],
      form: {
        client_id: '',
        delivery_type: 'en_local',
        delivery_person_id: null,
        pizzas: [{ pizza_size_id: '', quantity: 1 }],
        extras: []
      }
    };
  },
  mounted() {
    axios.get('/api/clients').then(res => this.clients = res.data);
    axios.get('/api/pizza-sizes').then(res => this.pizzaSizes = res.data);
    axios.get('/api/extra-ingredients').then(res => this.extras = res.data);
    axios.get('/api/employees').then(res => this.employees = res.data);
  },
  methods: {
    addPizza() {
      this.form.pizzas.push({ pizza_size_id: '', quantity: 1 });
    },
    addExtra() {
      this.form.extras.push({ extra_ingredient_id: '', quantity: 1 });
    },
    submit() {
      axios.post('/api/orders', this.form)
        .then(() => this.$router.push('/pedidos'));
    }
  }
};
</script>
