require('./bootstrap');
// import Notifications from 'vue-notification'
import Buefy from 'buefy'
import { ValidationProvider, extend, ValidationObserver } from 'vee-validate';
import "./validation";
import { library } from '@fortawesome/fontawesome-svg-core';
import {
    faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload, faEdit, faTrash, faPlus, faArrowsAlt, faExternalLinkAlt, faEnvelope, faHome, faUser, faPhoneAlt
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload, faEdit, faTrash, faPlus, faArrowsAlt, faExternalLinkAlt, faEnvelope, faHome, faUser, faPhoneAlt);

window.Vue = require("vue");

Vue.component('edit-menu', require('./components/EditMenu.vue').default);
Vue.component('nested-draggable', require('./components/NestedDraggable.vue').default);
// Vue.component('modal-editor', require('./components/ModalEditor.vue').default);
Vue.component('edit-item-form', require('./components/EditMenuItemForm.vue').default);
Vue.component('new-section-form', require('./components/NewMenuSectionForm.vue').default);
Vue.component('new-item-form', require('./components/NewMenuItemForm.vue').default);
Vue.component('get-started', require('./components/GetStarted.vue').default);
Vue.component('vue-fontawesome', FontAwesomeIcon);


// Vue.use(Notifications)
Vue.use(Buefy, {
    defaultIconComponent: 'vue-fontawesome',
    defaultIconPack: 'fas',
});
Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);


const app = new Vue({
    el: '#app',
});