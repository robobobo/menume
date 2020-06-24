require('./bootstrap');

window.Vue = require("vue");

Vue.component('edit-menu',require('./components/EditMenu.vue').default);

const app = new Vue({
    el: '#app',
});