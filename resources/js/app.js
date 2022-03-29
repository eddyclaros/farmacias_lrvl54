/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window._pl = require("./func_10251.js");






/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('Ajaxselect', require('./components/plugin_vue/selectAjax.vue',).default);


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('area-component', require('./components/servicios/AreaComponent.vue').default);
Vue.component('prestaciones-component', require('./components/servicios/PrestacionesComponent.vue').default);
Vue.component('ventas-component', require('./components/servicios/VentaServiciosComponent.vue').default);
Vue.component('histventas-component', require('./components/servicios/HistorialVentasComponent.vue').default);

Vue.component('descuentos-component', require('./components/configuraciones/DescuentosComponent.vue').default);
Vue.component('descproductos-component', require('./components/configuraciones/DescProductosComponent.vue').default);


Vue.component('linea-component', require('./components/productos/LineaComponent.vue').default);
Vue.component('producto-component', require('./components/productos/ProductoComponent.vue').default);
Vue.component('dispenser-component', require('./components/productos/DispenserComponent.vue').default);
Vue.component('formafarm-component', require('./components/productos/FormaFarmaceuticaComponent.vue').default);
Vue.component('categoria-component', require('./components/productos/CategoriaComponent.vue').default);

Vue.component('sucursal-component', require('./components/administracion/SucursalComponent.vue').default);
Vue.component('cargos-component', require('./components/administracion/CargosComponent.vue').default);

Vue.component('codificacion-component', require('./components/almacenes/CodificacionComponent.vue').default);
Vue.component('almacen-component', require('./components/almacenes/AlmacenComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu:0
        
    }
});
