require('./bootstrap');
// import Notifications from 'vue-notification'
import Buefy from 'buefy'
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload, faEdit, faTrash
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload, faEdit, faTrash);

window.Vue = require("vue");

Vue.component('edit-menu', require('./components/EditMenu.vue').default);
Vue.component('nested-draggable', require('./components/NestedDraggable.vue').default);
// Vue.component('modal-editor', require('./components/ModalEditor.vue').default);
Vue.component('edit-item-form', require('./components/EditMenuItemForm.vue').default);
// Vue.component('new-item-modal', require('./components/NewMenuItemModal.vue').default);
Vue.component('new-item-form', require('./components/NewMenuItemForm.vue').default);
Vue.component('vue-fontawesome', FontAwesomeIcon);

// Vue.use(Notifications)
Vue.use(Buefy, {
    defaultIconComponent: 'vue-fontawesome',
    defaultIconPack: 'fas',
});

const app = new Vue({
    el: '#app',
});