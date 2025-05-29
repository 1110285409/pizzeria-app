<template>
  <div>
    <h2>Nueva Materia Prima</h2>
    <form @submit.prevent="save">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.unit" placeholder="Unidad (ej. kg, g, l)" />
      <input v-model="form.current_stock" type="number" placeholder="Stock actual" />
      <button>Guardar</button>
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
  methods: {
    save() {
      axios.post('/api/raw-materials', this.form)
        .then(() => this.$router.push('/materias'));
    }
  }
}
</script>
