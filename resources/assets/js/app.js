
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

// ASRAMA
Vue.component('form-asrama-component', require('./components/Sekretariat/Asrama/FormAsramaComponent.vue'));
Vue.component('list-asrama-component', require('./components/Sekretariat/Asrama/ListAsramaComponent.vue'));
Vue.component('list-kobong-asrama-component', require('./components/Sekretariat/Asrama/ListAsramaKobongComponent.vue'));

// KELAS
Vue.component('form-kelas-component', require('./components/Sekretariat/Kelas/FormKelasComponent.vue'));
Vue.component('list-kelas-component', require('./components/Sekretariat/Kelas/ListKelasComponent.vue'))

// GURU
Vue.component('form-guru-component', require('./components/Sekretariat/Guru/FormGuruComponent.vue'));
Vue.component('list-guru-component', require('./components/Sekretariat/Guru/ListGuruComponent.vue'))



/**
* Vue Router
*
* @link http://router.vuejs.org/en/installation.html
*/
import VueRouter from 'vue-router';
Vue.use(VueRouter);
// define routes for users
const routes = [
{
  path: '/edit/guru/:id',
  name: 'editGuruForm',
  component: require('./components/Sekretariat/Guru/FormEditGuruComponent.vue')
},
{
  path: '/hapus/guru/:id',
  name: 'hapusGuru',
  component: require('./components/Sekretariat/Guru/DeleteGuruComponent.vue') 
},
// {
//   path: '/view/:id',
//   name: 'userView',
//   component: require('./components/user/view.vue')
// }
]
const router = new VueRouter({ routes });
const app = new Vue({
  router
}).$mount('#app');