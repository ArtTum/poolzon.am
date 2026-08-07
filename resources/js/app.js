import Vue from 'vue';
import VueRouter from 'vue-router'
import router from './routes';
import store from './store';
import Vuex from 'vuex';
import axios from 'axios';
import $ from 'jquery';
import Popper from 'popper.js';
import lodash from 'lodash';
import 'bootstrap';
import VueAxios from 'vue-axios';
import CKEditor from 'ckeditor4-vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Icon from 'vue-awesome/components/Icon';
import CategoriesForm from './components/categories/_formComponent.vue';
import PagesForm from './components/pages/_formComponent.vue';
import ColorsForm from './components/colors/_formComponent.vue';
import AppointmentsForm from './components/appointments/_formComponent.vue';
import BrandsForm from './components/brands/_formComponent.vue';
import TypesForm from './components/types/_formComponent.vue';
import SliderForm from './components/sliders/_formComponent.vue';
import BannerForm from './components/banners/_formComponent.vue';
import SocialsForm from './components/socials/_formComponent.vue';
import QuickSearchForm from './components/quick-search/_formComponent.vue';
import ParametersForm from './components/parameters/_formComponent.vue';
import ProductForm from './components/products/_formComponent.vue';
import OurProjectsForm from './components/our-projects/_formComponent.vue';
import App from './App.vue';

window.Vue = Vue;
window.$ = window.jQuery = $;
window.Popper = Popper;
window._ = lodash;

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
Vue.component('categories-form', CategoriesForm);
Vue.component('pages-form', PagesForm);
Vue.component('colors-form', ColorsForm);
Vue.component('appointments-form', AppointmentsForm);
Vue.component('brands-form', BrandsForm);
Vue.component('types-form', TypesForm);
Vue.component('slider-form', SliderForm);
Vue.component('banner-form', BannerForm);
Vue.component('socials-form', SocialsForm);
Vue.component('quick-search-form', QuickSearchForm);
Vue.component('parameters-form', ParametersForm);
Vue.component('product-form', ProductForm);
Vue.component('our-projects-form', OurProjectsForm);

new Vue(Vue.util.extend({ router, store }, App)).$mount('#app');
