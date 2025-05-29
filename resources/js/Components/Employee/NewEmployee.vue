<template>
  <div>
    <h2>Nuevo Empleado</h2>
    <form @submit.prevent="create">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.email" placeholder="Email" />
      <input v-model="form.password" type="password" placeholder="Contraseña" />
      <select v-model="form.position">
        <option value="cajero">Cajero</option>
        <option value="cocinero">Cocinero</option>
        <option value="mensajero">Mensajero</option>
        <option value="administrador">Administrador</option>
      </select>
      <input v-model="form.identification_number" placeholder="Identificación" />
      <input v-model="form.salary" type="number" placeholder="Salario" />
      <input v-model="form.hire_date" type="date" />
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
        email: '',
        password: '',
        position: '',
        identification_number: '',
        salary: '',
        hire_date: ''
      }
    };
  },
  methods: {
    create() {
      axios.post('/api/employees', this.form)
        .then(() => this.$router.push('/empleados'));
    }
  }
};
</script>
