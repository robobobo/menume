require('./bootstrap');
import Notifications from 'vue-notification'
import Buefy from 'buefy'

window.Vue = require("vue");

Vue.component('edit-menu',require('./components/EditMenu.vue').default);
Vue.component('nested-draggable',require('./components/NestedDraggable.vue').default);
Vue.component('modal-editor',require('./components/ModalEditor.vue').default);
Vue.component('new-item-modal',require('./components/NewMenuItemModal.vue').default);
Vue.component('new-item-form',require('./components/NewMenuItemForm.vue').default);
Vue.use(Notifications)
Vue.use(Buefy)

const app = new Vue({
    el: '#app',
});