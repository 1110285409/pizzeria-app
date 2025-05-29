<template>
  <div>
    <h2>Sucursales</h2>

    <form @submit.prevent="isEditing ? updateSucursal() : crearSucursal()">
      <input v-model="form.name" placeholder="Nombre de la sucursal" required />
      <input v-model="form.address" placeholder="Dirección" required />
      <button>{{ isEditing ? 'Actualizar' : 'Crear' }}</button>
    </form>

    <hr />

    <table>
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="sucursal in sucursales" :key="sucursal.id">
          <td>{{ sucursal.name }}</td>
          <td>{{ sucursal.address }}</td>
          <td>
            <button @click="editarSucursal(sucursal)">Editar</button>
            <button @click="eliminarSucursal(sucursal.id)">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'SucursalCrud',
  data() {
    return {
      sucursales: [],
      form: {
        name: '',
        address: ''
      },
      isEditing: false,
      editId: null
    };
  },
  mounted() {
    this.obtenerSucursales();
  },
  methods: {
    async obtenerSucursales() {
      const res = await axios.get('/api/branches');
      this.sucursales = res.data;
    },
    async crearSucursal() {
      await axios.post('/api/branches', this.form);
      this.form.name = '';
      this.form.address = '';
      this.obtenerSucursales();
    },
    editarSucursal(sucursal) {
      this.isEditing = true;
      this.editId = sucursal.id;
      this.form.name = sucursal.name;
      this.form.address = sucursal.address;
    },
    async updateSucursal() {
      await axios.put(`/api/branches/${this.editId}`, this.form);
      this.isEditing = false;
      this.editId = null;
      this.form.name = '';
      this.form.address = '';
      this.obtenerSucursales();
    },
    async eliminarSucursal(id) {
      if (confirm('¿Eliminar esta sucursal?')) {
        await axios.delete(`/api/branches/${id}`);
        this.obtenerSucursales();
      }
    }
  }
}
</script>
