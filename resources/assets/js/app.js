
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import store from './store'
import router from './routes'
import moment from 'moment'

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import Notifications from '@voerro/vue-notifications'

Vue.component('notifications', Notifications);

// import "./assets/css/nucleo-icons.css";
// import "./assets/css/nucleo-svg.css";
// import SoftUIDashboard from "./soft-ui-dashboard";
import softUiDashboard from './soft-ui-dashboard';
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

// import '@mdi/font/css/materialdesignicons.css'


// Object.assign( global, { JP_SMS: require('jambopay-sms')});
// window.x = require('jambopay-sms')
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/dist/vue-tel-input.css';

import VueNumber from "vue-number-animation";

Vue.use(VueTelInput);
Vue.use(VueNumber);

// import 'material-design-icons-iconfont/dist/material-design-icons.css'
Vue.use(VueMaterial)

Vue.use(Vuetify)
Vue.use(softUiDashboard)

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('LL')
    }
})

// Register Vue Components
// Vue.component('login-component', require('./components/LoginComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#root',
    vuetify : new Vuetify(),
    store,
    router
});
