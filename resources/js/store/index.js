import Vue from 'vue';
import Vuex from 'vuex';
import returnSliders from './modules/sliders/list.js';
import returnCategories from './modules/categories/all-categories.js';
import returnPages from './modules/pages/list.js';
import returnTypes from './modules/types/list.js';
import returnColors from './modules/colors/list.js';
import returnAppointments from './modules/appointments/list.js';
import returnBrands from './modules/brands/list.js';
import returnBanners from './modules/banners/list.js';
import returnSocials from './modules/socials/list.js';
import returnOrders from './modules/orders/list.js';
import returnProducts from './modules/products/list.js';
import returnParameters from './modules/parameters/all-parameters';
import returnOurProjects from './modules/our-projects/list.js';
Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        returnSliders,
        returnCategories,
        returnTypes,
        returnColors,
        returnAppointments,
        returnBrands,
        returnPages,
        returnBanners,
        returnSocials,
        returnProducts,
        returnParameters,
        returnOrders,
        returnOurProjects
    }
});
