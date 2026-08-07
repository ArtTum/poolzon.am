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
                            Цвета
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
                                 <span class="svg-icon svg-icon-primary svg-icon-2x kt-menu__link-icon"><!--begin::Svg Icon | path:/home/keenthemes/www/metronic/themes/metronic/theme/html/demo1/dist/../src/media/svg/icons/Design/Color-profile.svg--><svg
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <circle fill="#000000" cx="12" cy="9" r="5"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список расцветов
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">

                                        <router-link class="btn btn-brand btn-elevate btn-icon-sm"
                                                     :to="{ name: 'colors-create' }">
                                            <i class="la la-plus"></i>
                                            Добавить цвет
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
                                <draggable :list="list"  tag="tbody"  @change="log" :options="{animation:500}" >
                                    <tr ref="sort" :data-id="color.id" v-for="(color, index) in list"
                                        :key="color.id">
                                        <td align="center" style="cursor: grab; font-size: 20px" scope="row"><i
                                            class="la la-align-justify"></i></td>
                                        <td align="">{{ index+1  }}
                                        </td>
                                        <td width="190px">{{ color.lang[0].color_name }}</td>
                                        <td width="190px">{{ color.lang[1].color_name }}</td>
                                        <td>{{ (!color.color_status)? 'Пассивный' : 'Активный'}}</td>
                                        <td>
                                            <a v-on:click="alertDisplay(color.color_status, color.id)"
                                               style="cursor: pointer"
                                               class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                               title="Change Status"><i
                                                class="la la-lightbulb-o"></i>
                                            </a>
                                            <router-link :to="'/vagart-cms/colors/'+color.id+'/edit'"
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
                                    v-if="allReturnColorsIndex.count"
                                    :page-count="allReturnColorsIndex.count"
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
                                    <select v-if="allReturnColorsIndex.count" @change="changeData" v-model="pageCount"
                                            class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ allReturnColorsIndex.displaying }} из  {{ allReturnColorsIndex.totalCount }}
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
        name: "ColorsIndex",
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
            "allReturnColorsIndex",
        ]),

        methods: {
            sort: function (s) {
                //if s == current sort, reverse
                if (s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir === 'asc' ? 'desc' : 'asc';
                }
                this.currentSort = s;

                this.$store.commit('changeColorsStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnColorsIndex');
            },

            clickCallback: function (pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            changeData: function () {
                this.$store.commit('changeColorsStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sort_number: this.currentSortDir
                });
                this.$store.dispatch('returnColorsIndex');
            },

            search() {
                this.searchLoading = true;
                this.$store.commit('changeColorsStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    searchWord: this.searchWord
                });
                this.$store.dispatch('returnColorsIndex');
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
                        this.$store.commit('changeColorId', {
                            id
                        });
                        if (this.$store.dispatch('changeColorStatus')) {
                            this.$store.dispatch('returnColorsIndex');
                        }
                    }
                })
            },
            log(){
                this.$store.dispatch('returnColorSort', this.list);
            }
        },
        watch: {
            allReturnColorsIndex: function (val) {
                this.list = val.colors
            }
        }
    }
</script>
