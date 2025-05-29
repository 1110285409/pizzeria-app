<template>
  <div>
    <h2>Editar Materia Prima</h2>
    <form @submit.prevent="update">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.unit" placeholder="Unidad" />
      <input v-model="form.current_stock" type="number" placeholder="Stock actual" />
      <button>Actualizar</button>
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
        unit: '',
        current_stock: 0
      }
    };
  },
  mounted() {
    axios.get(`/api/raw-materials/${this.$route.params.id}`)
      .then(res => this.form = res.data);
  },
  methods: {
    update() {
      axios.put(`/api/raw-materials/${this.$route.params.id}`, this.form)
        .then(() => this.$router.push('/materias'));
    }
  }
}
</script>
