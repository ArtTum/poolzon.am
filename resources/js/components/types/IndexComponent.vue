<template>

    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Список </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Типы
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
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                       width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g
                                      stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0"
                                                                                                           width="24"
                                                                                                           height="24"></rect> <rect
                                      fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect> <path
                                      d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                      fill="#000000" opacity="0.3"></path></g></svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список типов
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">

                                        <router-link class="btn btn-brand btn-elevate btn-icon-sm"
                                                     :to="{ name: 'types-create' }">
                                            <i class="la la-plus"></i>
                                            Добавить тип
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
                                    <th scope="col">Название (арм)</th>
                                    <th scope="col">Название (рус)</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <draggable :list="list" tag="tbody" @change="log" :options="{animation:500}">
                                    <tr ref="sort" :data-id="type.id" v-for="(type, index) in list"
                                        :key="type.id">
                                        <td align="center" style="cursor: grab; font-size: 20px" scope="row"><i
                                            class="la la-align-justify"></i></td>
                                        <td align="">{{index+1 }}
                                        </td>
                                        <td width="190px">{{ type.lang[0].type_name }}</td>
                                        <td width="190px">{{ type.lang[1].type_name }}</td>
                                        <td>{{ (!type.type_status)? 'Пассивный' : 'Активный'}}</td>
                                        <td>
                                            <a v-on:click="alertDisplay(type.type_status, type.id)"
                                               style="cursor: pointer"
                                               class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                               title="Change Status"><i
                                                class="la la-lightbulb-o"></i>
                                            </a>
                                            <router-link :to="'/vagart-cms/types/'+type.id+'/edit'"
                                                         class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                                         title="Edit Ad"><i
                                                class="la la-edit"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </draggable>
                            </table>
                            <div v-if="false" class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="allReturnTypesIndex.count"
                                    :page-count="allReturnTypesIndex.count"
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
                                    <select v-if="allReturnTypesIndex.count" @change="changeData" v-model="pageCount"
                                            class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ allReturnTypesIndex.displaying }} из  {{ allReturnTypesIndex.totalCount }}
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
        name: "TypesIndex",
        display: "Table",
        order: 8,
        components: {
            draggable,
            Paginate
        },

        data() {
            return {
                list: [],
                dragging: false,
                searchLoading: false,
                enabled: true,
                pageCount: 10,
                page: 1,
                data: '',
                searchWord: '',
                currentSort: 'sort_number',
                currentSortDir: 'asc',
            }
        },
        created() {
            this.changeData();
        },
        computed: mapGetters([
            "allReturnTypesIndex",
        ]),

        methods: {
            log(){
                this.$store.dispatch('returnTypeSort', this.list);
            },
            sort: function (s) {
                //if s == current sort, reverse
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
                }
                this.currentSort = s;

                this.$store.commit('changeTypesStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnTypesIndex');
            },

            clickCallback: function (pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            changeData: function () {
                this.$store.commit('changeTypesStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnTypesIndex');
            },

            search() {
                this.searchLoading = true;
                this.$store.commit('changeTypesStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    searchWord: this.searchWord
                });
                this.$store.dispatch('returnTypesIndex');
                this.searchLoading = false;
            },
            alertDisplay(status, id) {
                this.$swal({
                    title: '',
                    text: status ? 'Вы уверены, что хотите отключить этот элемент? ' : 'Вы уверены, что хотите включить этот элемент?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Да',
                    cancelButtonText: 'Отменить',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        this.$store.commit('changeTypeId', {
                            id
                        });
                        if (this.$store.dispatch('changeTypeStatus')) {
                            this.$store.dispatch('returnTypesIndex');
                        }

                    }
                })
            },
        },
        watch: {
            allReturnTypesIndex: function (val) {
                this.list = val.types
            }
        }
    }
</script>
