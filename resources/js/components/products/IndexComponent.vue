<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Каталог  </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Продуктов
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-xs-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список продуктов
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">

                                        <router-link class="btn btn-brand btn-elevate btn-icon-sm"
                                                     :to="{ name: 'products-create' }">
                                            <i class="la la-plus"></i>
                                            Добавить продукт
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-12 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" @keyup="search()"  placeholder="Поиск..." id="generalSearch" v-model="searchWord">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                        <span><i class="la la-search"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <select @change="filter" class="browser-default custom-select" v-model="typeId" >
                                                    <option value="">Все типы</option>
                                                    <option v-for="type in allReturnProductsParam.types" :value="type.id">{{ type.type_name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <select @change="filter" class="browser-default custom-select" v-model="categoryId" >
                                                    <option value="">Все категории </option>
                                                    <option v-for="category in allReturnProductsParam.categories" :value="category.id">{{ category.category_name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                                                <select @change="filter" class="browser-default custom-select" v-model="brandId" >
                                                    <option value="">Все бренды </option>
                                                    <option v-for="brand in allReturnProductsParam.brands" :value="brand.id">{{ brand.brand_name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">

                                    </div>
                                </div>
                            </div>
                            <!--begin: Datatable -->
                            <table  class="table table-striped table-bordered dataTable table-checkable table-sorting ">
                                <thead>
                                <tr role="row">
                                    <th>No</th>
                                    <th scope="col">Название</th>
                                    <th scope="col">Тип</th>
                                    <th scope="col">Категории</th>
                                    <th scope="col">Бренд </th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr ref="sort" :data-id="product.id" v-for="(product, index) in allReturnProductsIndex.products" :key="product.id">
                                        <td align="">
                                            {{ (allReturnProductsIndex.totalCount - allReturnProductsIndex.offset) - index}}
                                            <img width="80px" :src="'/uploads/products/'+product.product_image">
                                        </td>
                                        <td>{{ product.product_name }}</td>
                                        <td>{{ product.type_name }}</td>
                                        <td>{{ product.category_name }}</td>
                                        <td> {{ product.brand_name }}</td>
                                        <td width="120px">
                                            <router-link  :to="'/vagart-cms/products/'+product.id+'/edit'"
                                                          class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Ad"><i
                                                class="la la-edit"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="allReturnProductsIndex.totalCount > 10 ? true : false" class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="allReturnProductsIndex.count"
                                    :page-count="allReturnProductsIndex.count"
                                    :page-range="5"
                                    :margin-pages="1"
                                    :click-handler="clickCallback"
                                    :prev-text="'<'"
                                    :next-text="'>'"
                                    :next-class="'kt-pagination__link--next'"
                                    :prev-class="'kt-pagination__link--prev'"
                                    :active-class="'kt-pagination__link--active'"
                                    :container-class="'kt-pagination__links'"
                                    :page-link-class="'kt-datatable__pager-link kt-datatable__pager-link-number'"
                                >
                                </paginate>
                                <div class="kt-pagination__toolbar">
                                    <select v-if="allReturnProductsIndex.count" @change="changeData" v-model="pageCount" class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ allReturnProductsIndex.displaying }} из  {{ allReturnProductsIndex.totalCount }}
                                    </span>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end:: Content -->
    </div>
    <!-- end:: Content -->

</template>

<script>
    import draggable from 'vuedraggable'
    import {mapGetters} from "vuex";
    import Paginate from 'vuejs-paginate'


    export default {
        name: "ProductIndex",
        display: "Table",
        order: 8,
        components: {
            draggable,
            Paginate,
        },

        data() {
            return {
                id: [],
                list: [],
                dragging: false,
                enabled: true,
                pageCount: 10,
                page: 1,
                data:'',
                searchWord:'',
                typeId: '',
                categoryId: '',
                brandId: '',
            }
        },
        mounted() {
            this.changeData();
        },
        updated(){

        },
        created(){
            this.$store.dispatch('returnProductsParam');
        },
        computed: mapGetters([
            "allReturnProductsIndex",
            "allReturnProductsParam",
        ]),

        methods: {
            clickCallback: function(pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            filter: function() {
                this.changeData();
            },
            changeData: function() {

                this.$store.commit('changeProducts', {pageNum:this.page, pageCount:this.pageCount, typeId:this.typeId, categoryId:this.categoryId, brandId: this.brandId });
                this.$store.dispatch('returnProductsIndex');
            },
            getComponentData() {
                return {
                    on: {
                        change: this.handleChange,
                    },
                };
            },
            search(){
                this.enabled = this.searchWord ? false : true;
                this.$store.commit('changeProducts', {pageNum:this.page, pageCount:this.pageCount, searchWord:this.searchWord});
                this.$store.dispatch('returnProductsIndex');
            },
        }
    }
</script>
