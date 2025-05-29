<template>
  <div>
    <h2>Editar Pizza</h2>
    <form @submit.prevent="update">
      <input v-model="form.name" placeholder="Nombre de la pizza" />
      <div v-for="(size, index) in form.sizes" :key="index">
        <select v-model="size.size">
          <option value="pequeña">Pequeña</option>
          <option value="mediana">Mediana</option>
          <option value="grande">Grande</option>
        </select>
        <input type="number" v-model="size.price" placeholder="Precio" />
      </div>
      <button type="button" @click="addSize">+ Tamaño</button>
      <button type="submit">Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: { name: '', sizes: [] }
    };
  },
  mounted() {
    axios.get(`/api/pizzas/${this.$route.params.id}`)
      .then(res => this.form = res.data);
  },
  methods: {
    addSize() {
      this.form.sizes.push({ size: 'mediana', price: 0 });
    },
    update() {
      axios.put(`/api/pizzas/${this.$route.params.id}`, this.form)
        .then(() => this.$router.push('/pizzas'));
    }
  }
}
</script>
