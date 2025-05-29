<template>
  <div>
    <h2>Editar Ingrediente</h2>
    <form @submit.prevent="update">
      <input v-model="name" placeholder="Nombre del ingrediente" />
      <button>Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { name: '' };
  },
  mounted() {
    axios.get(`/api/ingredients/${this.$route.params.id}`)
      .then(res => this.name = res.data.name);
  },
  methods: {
    update() {
      axios.put(`/api/ingredients/${this.$route.params.id}`, { name: this.name })
        .then(() => this.$router.push('/ingredientes'));
    }
  }
}
</script>
