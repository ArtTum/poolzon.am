import VueRouter from 'vue-router';
import DashboardComponent from './components/DashboardComponent.vue';
//sliders
import SlidersComponent from './components/sliders/IndexComponent.vue';
import CreateSlidersComponent from './components/sliders/CreateComponent.vue';
import EditSlidersComponent from './components/sliders/EditComponent.vue';
//banners
import BannersComponent from './components/banners/IndexComponent.vue';
import CreateBannersComponent from './components/banners/CreateComponent.vue';
import EditBannersComponent from './components/banners/EditComponent.vue';
//socials
import SocialsComponent from './components/socials/IndexComponent.vue';
import CreateSocialsComponent from './components/socials/CreateComponent.vue';
import EditSocialsComponent from './components/socials/EditComponent.vue';
//categories
import IndexCategoriesComponent from './components/categories/IndexComponent.vue';
import EditCategoriesComponent from './components/categories/EditComponent.vue';
import CreateCategoriesComponent from './components/categories/CreateComponent.vue';
//pages
import IndexPagesComponent from './components/pages/IndexComponent.vue';
import EditPagesComponent from './components/pages/EditComponent.vue';
import CreatePagesComponent from './components/pages/CreateComponent.vue';
//brands
import IndexBrandsComponent from './components/brands/IndexComponent.vue';
import EditBrandsComponent from './components/brands/EditComponent.vue';
import CreateBrandsComponent from './components/brands/CreateComponent.vue';
//types
import TypesComponent from './components/types/IndexComponent.vue';
import CreateTypesComponent from './components/types/CreateComponent.vue';
import EditTypesComponent from './components/types/EditComponent.vue';
//colors
import IndexColorsComponent from './components/colors/IndexComponent.vue';
import EditColorsComponent from './components/colors/EditComponent.vue';
import CreateColorsComponent from './components/colors/CreateComponent.vue';
//appointment
import IndexAppointmentsComponent from './components/appointments/IndexComponent.vue';
import EditAppointmentsComponent from './components/appointments/EditComponent.vue';
import CreateAppointmentsComponent from './components/appointments/CreateComponent.vue';
//products
import ProductsComponent from './components/products/IndexComponent.vue';
import CreateProductsComponent from './components/products/CreateComponent.vue';
import EditProductsComponent from './components/products/EditComponent.vue';
//parameters
import IndexParametersComponent from './components/parameters/IndexComponent.vue';
import EditParametersComponent from './components/parameters/EditComponent.vue';
//our-projects
import OurProjectsComponent from './components/our-projects/IndexComponent.vue';
import CreateOurProjectsComponent from './components/our-projects/CreateComponent.vue';
import EditOurProjectsComponent from './components/our-projects/EditComponent.vue';

export default new VueRouter({
    routes: [
        //products
        {
            name: 'dashboard',
            path: '/vagart-cms/dashboard',
            component: DashboardComponent,
        },
        {
            name: 'products',
            path: '/vagart-cms/products',
            component: ProductsComponent,
        },
        {
            name: 'products-create',
            path: '/vagart-cms/products/create',
            component: CreateProductsComponent,
        },
        {
            name: 'products-edit',
            path: '/vagart-cms/products/:id/edit',
            component: EditProductsComponent,
        },
        //socials
        {
            name: 'socials',
            path: '/vagart-cms/socials',
            component: SocialsComponent,
        },
        {
            name: 'socials-create',
            path: '/vagart-cms/social/create',
            component: CreateSocialsComponent,
        },
        {
            name: 'socials-edit',
            path: '/vagart-cms/socials/:id/edit',
            component: EditSocialsComponent,
        },
        //banners
        {
            name: 'banners',
            path: '/vagart-cms/banners',
            component: BannersComponent,
        },
        {
            name: 'banners-create',
            path: '/vagart-cms/banner/create',
            component: CreateBannersComponent,
        },
        {
            name: 'banners-edit',
            path: '/vagart-cms/banners/:id/edit',
            component: EditBannersComponent,
        },
        //sliders
        {
            name: 'sliders',
            path: '/vagart-cms/sliders',
            component: SlidersComponent,
        },
        {
            name: 'sliders-create',
            path: '/vagart-cms/slider/create',
            component: CreateSlidersComponent,
        },
        {
            name: 'sliders-edit',
            path: '/vagart-cms/sliders/:id/edit',
            component: EditSlidersComponent,
        },
        //pages
        {
            name: 'pages',
            path: '/vagart-cms/pages',
            component: IndexPagesComponent,
        },
        {
            name: 'pages-edit',
            path: '/vagart-cms/pages/:id/edit',
            component: EditPagesComponent,
        },
        {
            name: 'pages-create',
            path: '/vagart-cms/pages/create',
            component: CreatePagesComponent,
        },
        //categories
        {
            name: 'categories',
            path: '/vagart-cms/categories',
            component: IndexCategoriesComponent,
        },
        {
            name: 'categories-edit',
            path: '/vagart-cms/categories/:id/edit',
            component: EditCategoriesComponent,
        },
        {
            name: 'categories-create',
            path: '/vagart-cms/categories/create',
            component: CreateCategoriesComponent,
        },
        //brands
        {
            name: 'brands',
            path: '/vagart-cms/brands',
            component: IndexBrandsComponent,
        },
        {
            name: 'brands-edit',
            path: '/vagart-cms/brands/:id/edit',
            component: EditBrandsComponent,
        },
        {
            name: 'brands-create',
            path: '/vagart-cms/brands/create',
            component: CreateBrandsComponent,
        },
        //types
        {
            name: 'types',
            path: '/vagart-cms/types',
            component: TypesComponent,
        },
        {
            name: 'types-create',
            path: '/vagart-cms/types/create',
            component: CreateTypesComponent,
        },
        {
            name: 'types-edit',
            path: '/vagart-cms/types/:id/edit',
            component: EditTypesComponent,
        },
        //colors
        {
            name: 'colors',
            path: '/vagart-cms/colors',
            component: IndexColorsComponent,
        },
        {
            name: 'colors-edit',
            path: '/vagart-cms/colors/:id/edit',
            component: EditColorsComponent,
        },
        {
            name: 'colors-create',
            path: '/vagart-cms/colors/create',
            component: CreateColorsComponent,
        },
        //appointments
        {
            name: 'appointments',
            path: '/vagart-cms/appointments',
            component: IndexAppointmentsComponent,
        },
        {
            name: 'appointments-edit',
            path: '/vagart-cms/appointments/:id/edit',
            component: EditAppointmentsComponent,
        },
        {
            name: 'appointments-create',
            path: '/vagart-cms/appointments/create',
            component: CreateAppointmentsComponent,
        },
        //parameters
        {
            name: 'parameters',
            path: '/vagart-cms/parameters',
            component: IndexParametersComponent,
        },
        {
            name: 'parameters-edit',
            path: '/vagart-cms/parameters/:id/edit',
            component: EditParametersComponent,
        },
        //OurProjects
        {
            name: 'our-projects',
            path: '/vagart-cms/our-projects',
            component: OurProjectsComponent,
        },
        {
            name: 'our-projects-create',
            path: '/vagart-cms/our-projects/create',
            component: CreateOurProjectsComponent,
        },
        {
            name: 'our-projects-edit',
            path: '/vagart-cms/our-projects/:id/edit',
            component: EditOurProjectsComponent,
        },
    ],
    mode: 'history'
});