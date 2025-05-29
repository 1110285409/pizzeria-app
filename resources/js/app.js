import '../css/app.css';
import './bootstrap';

import { createApp } from 'vue';
import App from './App.vue';
import router from './router';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import { library } from '@fortawesome/fontawesome-svg-core';
import { faEdit, faTrash, faPlus } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faEdit, faTrash, faPlus);

const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(VueSweetalert2);
app.use(router);
app.mount('#app');

