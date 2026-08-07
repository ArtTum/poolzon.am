<template>
    <div id="kt_content"
         class="kt-content min-height kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div id="kt_subheader" class="kt-subheader   kt-grid__item">
            <div data-v-1a16a835="" class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main"><h3 class="kt-subheader__title">
                    Рабочая панель </h3> <span class="kt-subheader__separator kt-hidden"></span>
                </div>
            </div>
        </div>
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
                                    Заказы
                                </h3>
                            </div>

                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                                <div class="row align-items-center">
                                </div>
                            </div>
                            <!--begin: Datatable -->
                            <table class="table table-striped table-bordered dataTable table-checkable table-sorting ">
                                <thead>
                                <tr role="row">
                                    <th :class="sorting ? 'sorting_desc' : 'sorting_asc'" scope="col" @click="sort">No
                                    </th>
                                    <th scope="col">Емайл</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Фамилия</th>
                                    <th scope="col">Телефон</th>
                                    <th scope="col">Получателя Имя</th>
                                    <th scope="col">Получателя Фамилия</th>
                                    <th scope="col">Получателя Телефон</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Способ оплаты</th>
                                    <th scope="col">создано</th>
                                    <th scope="col">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :data-id="order.id"
                                    v-for="(order, index) in allReturnOrdersIndex.orders"
                                    :key="index">
                                    <td>{{
                                            sorting ? allReturnOrdersIndex.offset + index + 1 :
                                                (allReturnOrdersIndex.totalCount - allReturnOrdersIndex.offset) - index
                                        }}
                                    </td>
                                    <td>{{ order.email }}</td>
                                    <td>{{ order.first_name }}</td>
                                    <td>{{ order.last_name }}</td>
                                    <td>{{ order.phone }}</td>
                                    <td>{{ order.p_first_name }}</td>
                                    <td>{{ order.p_last_name }}</td>
                                    <td>{{ order.p_phone }}</td>
                                    <td>{{ order.status }}</td>
                                    <td>{{ order.type == 1 ? 'Картой онлайн' : 'Оплата наличными' }}</td>
                                    <td>{{ order.created_at }}</td>
                                    <td width="134px">
                                        <button @click="orderView(order.id)" type="button" class="btn btn-primary"
                                                data-toggle="modal" data-target="#exampleModalLong">
                                            Просмотр заказа
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- Modal-->
                            <div class="modal fade" id="exampleModalLong" data-backdrop="static" tabindex="-1"
                                 role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Заказы</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i aria-hidden="true" class="ki ki-close"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div v-if="allReturnOrdersGet.orderView" class="flex-table flex-table--tertiary">
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Улица: </span></div>
                                                    <div class="flex-table__column"><span>{{ allReturnOrdersGet.orderView.address }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Квартира / Дом: </span></div>
                                                    <div class="flex-table__column"><span>{{ allReturnOrdersGet.orderView.home }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Подъезд: </span></div>
                                                    <div class="flex-table__column"><span>{{
                                                            allReturnOrdersGet.orderView.entrance
                                                        }}</span></div>
                                                </div>
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Этаж: </span></div>
                                                    <div class="flex-table__column"><span>{{ allReturnOrdersGet.orderView.floor }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Домофон: </span></div>
                                                    <div class="flex-table__column"><span>{{
                                                            allReturnOrdersGet.orderView.intercom
                                                        }}</span></div>
                                                </div>
                                                <div class="flex-table__row flex">
                                                    <div class="flex-table__column"><span>Комментарии: </span></div>
                                                    <div class="flex-table__column"><span>{{ allReturnOrdersGet.orderView.comment }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-if="allReturnOrdersGet.orderView" class="inner-container margin-top-large margin-bottom-large">
                                                <h3 class="font-medium font-primary--bold margin-bottom-large">Ваши
                                                    заказы</h3>
                                                <div class="row row-flex flex flex--wrap align-items--stretch">
                                                    <div v-for="(product) in allReturnOrdersGet.products"
                                                         class="col-12 col-md-12 col-xs-12 margin-bottom-large-xs">
                                                        <div class="product-item product-item--secondary flex">
                                                            <div class="product-item__img bg-contain">
                                                                <img width="50" :src="product.attributes.image">
                                                            </div>
                                                            <div class="product-item__info">
                                                                <p class="product-item__title">
                                                                    <span class="font-primary--medium">
                                                                        {{ product.name }}
                                                                    </span>
                                                                    - {{ product.price }} драм
                                                                </p>
                                                                <p class="product-item__title">
                                                                    <span class="font-primary--medium">
                                                                      количество - {{ product.quantity }}
                                                                    </span>
                                                                </p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="block-container__inner">
                                                        <div
                                                            class="flex align-items--center justify--space-between order-box__row">
                                                            <span
                                                                class="order-box__col font-medium font-primary--medium">Ваша корзина: </span>
                                                            <span class="text-right order-box__count"><span
                                                                class="total-count">{{ allReturnOrdersGet.orderView.total_count }}</span>  Товар</span>
                                                        </div>
                                                        <div
                                                            class="flex align-items--center justify--space-between order-box__row">
                                                            <span class="order-box__col">Доставка: </span>
                                                            <span
                                                                class="text-right font-primary--medium font-standard no-wrap">
                                                                 1,000<span class="font-small margin-left-small-xs"><i class="icon-dram"></i></span>
                                                            </span>
                                                        </div>
                                                        <div
                                                            class="flex align-items--center justify--space-between order-box__row border border--top">
                                                            <span
                                                                class="order-box__col font-medium font-primary--medium">Общая стоимость: </span>
                                                            <span class="text-right font-standard price">
                                                               <span class="price__actual no-wrap"><span class="total-price">{{ parseInt(allReturnOrdersGet.orderView.total_price) + 1000 }}</span><span
                                                                   class="price__icon"><i class="icon-dram"></i></span></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold"
                                                    data-dismiss="modal">Закрыть
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="allReturnOrdersIndex.totalCount > 10 ? true : false"
                                 class="kt-pagination  kt-pagination--brand">
                                <paginate
                                    v-if="allReturnOrdersIndex.count"
                                    :page-count="allReturnOrdersIndex.count"
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
                                    <select v-if="allReturnOrdersIndex.count" @change="changeData" v-model="pageCount"
                                            class="form-control kt-font-brand" style="width: 60px;">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="pagination__desc">
                                        Показано {{
                                            allReturnOrdersIndex.displaying
                                        }} из  {{ allReturnOrdersIndex.totalCount }}
                                    </span>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import draggable from 'vuedraggable'
import {mapGetters} from "vuex";
import Paginate from 'vuejs-paginate'
import ClipLoader from 'vue-spinner/src/ClipLoader.vue';

export default {
    name: "OrderIndex",
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
        "allReturnOrdersIndex",
        "allReturnOrdersGet",
    ]),

    methods: {
        sort() {
            this.sorting = !this.sorting;
            this.$store.commit('changeOrdersStates', {
                pageNum: this.page,
                pageCount: this.pageCount,
                sorting: this.sorting,
            });
            this.$store.dispatch('returnOrdersIndex');
        },

        clickCallback: function (pageNum) {
            this.page = pageNum;
            this.changeData();
        },

        changeData: function () {
            this.$store.commit('changeOrdersStates', {
                pageNum: this.page,
                pageCount: this.pageCount,
                sorting: this.sorting,
            });
            this.$store.dispatch('returnOrdersIndex');
        },
        orderView: function (id) {
            this.$store.commit('changeOrdersGet', id);
            this.$store.dispatch('returnOrdersGet');
        },
    },
}
</script>
<style>
.flex {
    display: flex;
}

.margin-bottom-large-xs {
    margin-bottom: 5px;
    border-top: 1px solid;
}
</style>
