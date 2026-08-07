nam<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">бренды </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            бренды
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
                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect> <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"></path> <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"></path></g></svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список бренд
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                        <router-link class="btn btn-brand btn-elevate btn-icon-sm"
                                                     :to="{ name: 'brands-create' }">
                                            <i class="la la-plus"></i>
                                            Добавить бренд
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" @keyup="search()"
                                                           placeholder="Search..." id="generalSearch"
                                                           v-model="searchWord">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                        <span><i class="la la-search"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div v-if="searchLoading"
                                                 class="col-md-2 kt-margin-b-20-tablet-and-mobile d-flex">
                                                <clip-loader color="gray"></clip-loader>
                                            </div>
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                                            </div>
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                        <a href="#" class="btn btn-default kt-hidden">
                                            <i class="la la-cart-plus"></i> New Order
                                        </a>
                                        <div
                                            class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <!--begin: Datatable -->
                            <table class="table table-striped table-bordered dataTable table-checkable table-sorting ">
                                <thead>
                                <tr role="row">
                                    <th scope="col"></th>
                                    <th :class="'sorting_'+currentSortDir" scope="col" @click="sort('sort_number')">No
                                    </th>
                                    <th scope="col">Название категории</th>
                                    <th scope="col">Псевдоним</th>
                                    <th scope="col">Мета Title</th>
                                    <th scope="col">Мета Keywords</th>
                                    <th scope="col">Мета Description</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>

                                <draggable :list="list" tag="tbody" @change="log" :options="{animation:500}">
                                    <tr ref="sort" :data-id="brand.id"
                                        v-for="(brand, index) in list" :key="index">
                                        <td align="center" style="cursor: grab; font-size: 20px" scope="row"><i
                                            class="la la-align-justify"></i></td>
                                        <td align="">{{ (currentSortDir=='asc') ?
                                            allReturnBrandsIndex.offset+index+1 :
                                            (allReturnBrandsIndex.totalCount - allReturnBrandsIndex.offset)-
                                            index }}
                                            <img width="80px" :src="'/uploads/brands/'+brand.brand_image">
                                        </td>
                                        <td>{{ brand.brand_name }}</td>
                                        <td>{{ brand.alias }}</td>
                                        <td>{{ brand.meta_title }}</td>
                                        <td>{{ brand.meta_keys }}</td>
                                        <td>{{ brand.meta_description }}</td>
                                        <td>{{ !brand.brand_status ? 'Пассивный' : 'Активный'}}</td>
                                        <td>
                                            <a @click="alertDisplay(brand.brand_status, brand.id)" style="cursor: pointer"
                                               class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                               title="Change Status"><i
                                                class="la la-lightbulb-o"></i>
                                            </a>
                                            <router-link :to="'/vagart-cms/brands/'+brand.id+'/edit'"
                                                         class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                         title="Edit Ad"><i
                                                class="la la-edit"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </draggable>
                            </table>
                            <div v-if="allReturnBrandsIndex.totalCount > 10 ? true : false"
                                 class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="allReturnBrandsIndex.count"
                                    :page-count="allReturnBrandsIndex.count"
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
                                    <select v-if="allReturnBrandsIndex.count" @change="changeData"
                                            v-model="pageCount" class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ allReturnBrandsIndex.displaying }} из  {{ allReturnBrandsIndex.totalCount }}
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

</template>

<script>
    import draggable from 'vuedraggable'
    import {mapGetters} from "vuex";
    import Paginate from 'vuejs-paginate'

    export default {
        name: "BrandsIndex",
        display: "Table",
        order: 8,
        components: {
            draggable,
            Paginate
        },

        data() {
            return {
                id: [],
                list: [],
                dragging: false,
                searchLoading: false,
                enabled: true,
                pageCount: 10,
                page: 1,
                data: '',
                searchWord: '',

                currentSort: 'order_number',
                currentSortDir: 'asc',
            }
        },
        mounted() {

            this.changeData();

        },
        updated() {

        },
        computed: mapGetters([
            "allReturnBrandsIndex",
        ]),

        methods: {
            log(){
                this.$store.dispatch('returnBrandSort', this.list);
            },
            sort(s) {
                //if s == current sort, reverse
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
                }
                this.currentSort = s;

                this.$store.commit('changeBrands', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnBrandsIndex');
            },

            clickCallback: function (pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            changeData: function () {
                this.$store.commit('changeBrands', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnBrandsIndex');
            },
            handleChange() {
                let el = document.querySelectorAll('tr[data-id]');
                let dataSort = [];
                for (let i = 0; i < el.length; i++) {
                    dataSort.push(el[i].getAttribute('data-id'));
                }

                this.$store.commit('changeBrands', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    dataSort: dataSort,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnBrandsIndex');
            },
            getComponentData() {
                return {
                    on: {
                        change: this.handleChange,
                    },
                };
            },

            search() {
                this.searchLoading = true;
                this.$store.commit('changeBrands', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    searchWord: this.searchWord
                });
                this.$store.dispatch('returnBrandsIndex');
                this.searchLoading = false;
            },

            alertDisplay(status, id) {
                this.$swal({
                    title: '',
                    text: status ? 'Вы уверены, что хотите отключить эту категорию?' : 'Вы уверены, что хотите включить эту категорию?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Да',
                    cancelButtonText: 'Отменить',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        this.$store.commit('changeBrandId', {
                            id
                        });
                        if (this.$store.dispatch('changeBrandStatus')) {
                            this.$store.dispatch('returnBrandsIndex');
                        }
                    }
                })
            },

        },
        watch: {
            allReturnBrandsIndex: function (val) {
                this.list = val.brands
            }
        }
    }
</script>

<style scoped>
</style>
