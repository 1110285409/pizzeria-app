<template>
  <div>
    <h2>Empleados</h2>
    <router-link to="/empleados/nuevo">Nuevo Empleado</router-link>
    <ul>
      <li v-for="emp in employees" :key="emp.id">
        {{ emp.user.name }} - {{ emp.position }}
        <router-link :to="`/empleados/${emp.id}/editar`">Editar</router-link>
        <button @click="remove(emp.id)">Eliminar</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return { employees: [] };
  },
  mounted() {
    this.load();
  },
  methods: {
    load() {
      axios.get('/api/employees').then(res => {
        this.employees = res.data;
      });
    },
    remove(id) {
      if (confirm('¿Eliminar empleado?')) {
        axios.delete(`/api/employees/${id}`).then(() => this.load());
      }
    }
  }
};
</script>
