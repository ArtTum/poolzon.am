window.Vue = require('vue');
import VueRouter from 'vue-router'
import router from './routes';
import store from './store';
import Vuex from 'vuex';
import axios from 'axios';
import VueAxios from 'vue-axios';
import CKEditor from 'ckeditor4-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Icon from 'vue-awesome/components/Icon';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

Vue.use(VueAxios, axios);
Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(VueSweetalert2);
Vue.use( CKEditor );
Vue.component('v-icon', Icon);
Vue.component('categories-form', require('./components/categories/_formComponent.vue').default);
Vue.component('pages-form', require('./components/pages/_formComponent.vue').default);
Vue.component('colors-form', require('./components/colors/_formComponent.vue').default);
Vue.component('appointments-form', require('./components/appointments/_formComponent.vue').default);
Vue.component('brands-form', require('./components/brands/_formComponent.vue').default);
Vue.component('types-form', require('./components/types/_formComponent.vue').default);
Vue.component('slider-form', require('./components/sliders/_formComponent.vue').default);
Vue.component('banner-form', require('./components/banners/_formComponent.vue').default);
Vue.component('socials-form', require('./components/socials/_formComponent.vue').default);
Vue.component('socials-form', require('./components/socials/_formComponent.vue').default);
Vue.component('quick-search-form', require('./components/quick-search/_formComponent.vue').default);
Vue.component('parameters-form', require('./components/parameters/_formComponent.vue').default);
Vue.component('product-form', require('./components/products/_formComponent.vue').default);
Vue.component('our-projects-form', require('./components/our-projects/_formComponent.vue').default);

import App from './App.vue';
const app = new Vue(Vue.util.extend({ router, store }, App)).$mount('#app');
