<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Каталог</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Слайдеры
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
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                         class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none"
                                                                fill-rule="evenodd"><rect x="0" y="0" width="24"
                                                                                          height="24"></rect> <path
                                        d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z"
                                        fill="#000000" opacity="0.3"></path> <path
                                        d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z"
                                        fill="#000000"></path></g></svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список слайдеры
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">

                                        <router-link class="btn btn-brand btn-elevate btn-icon-sm"
                                                     :to="{ name: 'sliders-create' }">
                                            <i class="la la-plus"></i>
                                            Добавить слайдеры
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
                                                    <input type="text" class="form-control" @keyup="search()"
                                                           placeholder="Поиск..." id="generalSearch"
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
                                    <th :class="sorting ? 'sorting_desc' : 'sorting_asc'" scope="col" @click="sort">No
                                    </th>
                                    <th scope="col">Название</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :data-id="slider.id"
                                    v-for="(slider, index) in allReturnSlidersIndex.sliders"
                                    :key="index">
                                    <td>{{ sorting ? allReturnSlidersIndex.offset+index+1 :
                                        (allReturnSlidersIndex.totalCount - allReturnSlidersIndex.offset)- index }}
                                        <img width="80px" :src="'/uploads/sliders/'+slider.slider_image">
                                    </td>
                                    <td>{{ slider.slider_name }}</td>
                                    <td>{{ slider.url }}</td>
                                    <td>{{ (!slider.slider_status)? 'Пассивный' : 'Активный'}}</td>
                                    <td width="120px">
                                        <a @click="alertDisplay(slider.slider_status, slider.id)"
                                           style="cursor: pointer"
                                           class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Change Status"><i
                                            class="la la-lightbulb-o"></i>
                                        </a>
                                        <router-link :to="'/vagart-cms/sliders/'+slider.id+'/edit'"
                                                     class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Ad">
                                            <i
                                                class="la la-edit"></i>
                                        </router-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-if="allReturnSlidersIndex.totalCount > 10 ? true : false"
                                 class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="allReturnSlidersIndex.count"
                                    :page-count="allReturnSlidersIndex.count"
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
                                    <select v-if="allReturnSlidersIndex.count" @change="changeData" v-model="pageCount"
                                            class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{ allReturnSlidersIndex.displaying }} из  {{ allReturnSlidersIndex.totalCount }}
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
    import ClipLoader from 'vue-spinner/src/ClipLoader.vue';

    export default {
        name: "SliderIndex",
        display: "Table",
        order: 8,
        components: {
            draggable,
            Paginate,
            ClipLoader
        },

        data() {
            return {
                dragging: false,
                searchLoading: false,
                pageCount: 10,
                page: 1,
                data: '',
                searchWord: '',
                sorting: true,
            }
        },
        mounted() {
            this.changeData();
        },
        created() {

        },
        computed: mapGetters([
            "allReturnSlidersIndex"
        ]),

        methods: {
            sort() {
                this.sorting = !this.sorting;
                this.$store.commit('changeSlidersStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sorting: this.sorting,
                });
                this.$store.dispatch('returnSlidersIndex');
            },

            clickCallback: function (pageNum) {
                this.page = pageNum;
                this.changeData();
            },

            changeData: function () {
                this.$store.commit('changeSlidersStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    sorting: this.sorting,
                });
                this.$store.dispatch('returnSlidersIndex');
            },

            search() {
                this.searchLoading = true;
                this.$store.commit('changeSlidersStates', {
                    pageNum: this.page,
                    pageCount: this.pageCount,
                    searchWord: this.searchWord
                });
                this.$store.dispatch('returnSlidersIndex');
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
                        this.$store.commit('changeSlidersGet', {
                            id
                        });
                        if (this.$store.dispatch('changeSliderStatus')) {
                            this.$store.dispatch('returnSlidersIndex');
                        }
                    }
                })
            },
        },
    }
</script>
