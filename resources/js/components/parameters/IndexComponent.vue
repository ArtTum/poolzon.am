<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Параметры </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Параметры
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
                                    Список Параметры
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                                <div class="kt-input-icon kt-input-icon--left">
                                                    <input type="text" class="form-control" @keyup="search()"  placeholder="Search..." id="generalSearch" v-model="searchWord">
                                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                        <span><i class="la la-search"></i></span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                                            </div>
                                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--begin: Datatable -->
                            <table  class="table table-striped table-bordered dataTable table-checkable table-sorting ">
                                <thead>
                                <tr role="row">
                                    <th :class="'sorting_'+currentSortDir" scope="col" @click="sort('sort_number')">No</th>
                                    <th scope="col">Ключ</th>
                                    <th scope="col">Параметры (арм)</th>
                                    <th scope="col">Параметры (рус)</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>

                                <tbody >
                                    <tr ref="sort" :data-id="item.id" v-for="(item, index) in listData.quickSearch" :key="item.name">
                                        <td align="">{{ (currentSortDir=='desc') ? listData.offset+index+1 : (listData.totalCount - listData.offset)- index }}</td>
                                        <td width="250px">{{ item.key }}</td>
                                        <td width="250px">{{ item.lang[0].text }}</td>
                                        <td width="250px">{{ item.lang[1].text }}</td>
                                        <td>
                                            <router-link  :to="'/vagart-cms/parameters/'+item.id+'/edit'"
                                                          class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Ad"><i
                                                class="la la-edit"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div v-if="listData.totalCount > 10 ? true : false" class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="listData.count"
                                    :page-count="listData.count"
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
                                    <select v-if="listData.count" @change="changeData" v-model="pageCount" class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ listData.displaying }} из  {{ listData.totalCount }}
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
        name: "parametersIndex",
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
                listData: [],
                dragging: false,
                enabled: true,
                pageCount: 10,
                page: 1,
                data:'',
                searchWord:'',

                currentSort:'sort_number',
                currentSortDir:'desc',
            }
        },
        mounted() {

            this.changeData();

        },
        updated(){

        },
        computed: mapGetters([
            "allReturnParameters",
        ]),

        methods: {

            sort:function(s) {
                //if s == current sort, reverse
                if(s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                }
                this.currentSort = s;

                this.$store.commit('changeParameters', {pageNum:this.page, pageCount:this.pageCount, sort_number:this.currentSortDir });
                this.$store.dispatch('returnParameters');
            },

            clickCallback: function(pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            changeData: function() {
                this.$store.commit('changeParameters', {pageNum:this.page, pageCount:this.pageCount, sort_number:this.currentSortDir });
                this.$store.dispatch('returnParameters');
            },

            search(){
                this.$store.commit('changeParameters', {pageNum:this.page, pageCount:this.pageCount, searchWord:this.searchWord});
                this.$store.dispatch('returnParameters');
            },



        },
        watch: {
            allReturnParameters: function (val) {
                this.listData = val;
            },
        }
    }
</script>

<style scoped>
</style>
