import VueRouter from 'vue-router';
import Crud from './core/crud';
import swal from 'sweetalert';

window.Vue = require('vue');
window.axios = require('axios');
window.Crud = Crud;

Vue.use(VueRouter);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
