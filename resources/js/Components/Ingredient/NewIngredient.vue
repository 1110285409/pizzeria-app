<template>
  <div>
    <h2>Nuevo Ingrediente</h2>
    <form @submit.prevent="save">
      <input v-model="name" placeholder="Nombre del ingrediente" />
      <button>Guardar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { name: '' };
  },
  methods: {
    save() {
      axios.post('/api/ingredients', { name: this.name })
        .then(() => this.$router.push('/ingredientes'));
    }
  }
}
</script>
