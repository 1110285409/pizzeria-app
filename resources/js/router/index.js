import { createRouter, createWebHistory } from 'vue-router';

import BranchList from '../views/BranchList.vue';
import NewBranch from '../components/Branch/NewBranch.vue';
import EditBranch from '../components/Branch/EditBranch.vue';

import EmployeeList from '../views/EmployeeList.vue';
import NewEmployee from '../components/Employee/NewEmployee.vue';
import EditEmployee from '../components/Employee/EditEmployee.vue';

import PizzaList from '../views/PizzaList.vue';
import NewPizza from '../components/Pizza/NewPizza.vue';
import EditPizza from '../components/Pizza/EditPizza.vue';

import OrderList from '../views/OrderList.vue';
import NewOrder from '../components/Order/NewOrder.vue';

import RawMaterialList from '../views/RawMaterialList.vue';
import NewRawMaterial from '../components/RawMaterial/NewRawMaterial.vue';
import EditRawMaterial from '../components/RawMaterial/EditRawMaterial.vue';

const routes = [
  { path: '/sucursales', component: BranchList },
  { path: '/sucursales/nueva', component: NewBranch },
  { path: '/sucursales/:id/editar', component: EditBranch },

  { path: '/empleados', component: EmployeeList },
  { path: '/empleados/nuevo', component: NewEmployee },
  { path: '/empleados/:id/editar', component: EditEmployee },

  { path: '/pizzas', component: PizzaList },
  { path: '/pizzas/nueva', component: NewPizza },
  { path: '/pizzas/:id/editar', component: EditPizza },

  { path: '/ingredientes', component: IngredientList },
  { path: '/ingredientes/nuevo', component: NewIngredient },
  { path: '/ingredientes/:id/editar', component: EditIngredient },
  
  { path: '/pedidos', component: OrderList },
  { path: '/pedidos/nuevo', component: NewOrder },

  { path: '/materias', component: RawMaterialList },
  { path: '/materias/nueva', component: NewRawMaterial },
  { path: '/materias/:id/editar', component: EditRawMaterial },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
