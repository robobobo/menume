require('./bootstrap');

window.Vue = require("vue");

Vue.component('edit-menu',require('./components/EditMenu.vue').default);
Vue.component('nested-draggable',require('./components/NestedDraggable.vue').default);
Vue.component('modal-editor',require('./components/ModalEditor.vue').default);

const app = new Vue({
    el: '#app',
});