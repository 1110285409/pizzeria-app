<template>
  <div>
    <h2>Editar Empleado</h2>
    <form @submit.prevent="update">
      <input v-model="form.name" placeholder="Nombre" />
      <input v-model="form.email" placeholder="Email" />
      <select v-model="form.position">
        <option value="cajero">Cajero</option>
        <option value="cocinero">Cocinero</option>
        <option value="mensajero">Mensajero</option>
        <option value="administrador">Administrador</option>
      </select>
      <input v-model="form.identification_number" placeholder="Identificación" />
      <input v-model="form.salary" type="number" placeholder="Salario" />
      <input v-model="form.hire_date" type="date" />
      <button>Actualizar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {}
    };
  },
  mounted() {
    axios.get(`/api/employees/${this.$route.params.id}`)
      .then(res => {
        this.form = {
          name: res.data.user.name,
          email: res.data.user.email,
          position: res.data.position,
          identification_number: res.data.identification_number,
          salary: res.data.salary,
          hire_date: res.data.hire_date
        };
      });
  },
  methods: {
    update() {
      axios.put(`/api/employees/${this.$route.params.id}`, this.form)
        .then(() => this.$router.push('/empleados'));
    }
  }
};
</script>
