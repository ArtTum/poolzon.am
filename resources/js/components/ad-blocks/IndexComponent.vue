<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Рекламный блок </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Рекламный блок
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Subheader -->

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-xs-12">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
                                <span class="kt-portlet__head-icon">
                                    <i class="kt-font-brand flaticon2-line-chart"></i>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Список рекламных блок
                                </h3>

                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <!--begin: Datatable -->
                            <table id="kt_table_1" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr role="row">
                                    <th scope="col">No</th>
                                    <th scope="col">Название Рекламный блок</th>
                                    <th scope="col">Статус</th>
                                    <th scope="col">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, index) in allReturnAdIndex">
                                    <td>{{ index +1}}</td>
                                    <td>{{ item.ad_block_name }}</td>
                                    <td width="140px">{{ (!item.hidden)? 'Пассивный' : 'Активный'}}</td>
                                    <td>
                                        <a  v-on:click="alertDisplay(item.is_hidden, item.id)" style="cursor: pointer"
                                            class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Change Status"><i
                                            class="la la-lightbulb-o"></i>
                                        </a>
                                        <router-link  :to="'/vagart-cms/ad-blocs/'+item.id+'/edit'"
                                           class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit Ad"><i
                                            class="la la-edit"></i>
                                        </router-link>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end:: Content -->
    </div>

</template>

<script>
    import {mapGetters} from "vuex";
    export default {
        name: "AdBlocks",
        components: {
        },
        data() {
            return {
                searchMpn:''
            }
        },
        mounted() {
            this.$store.commit('changeAd', this.searchMpn);
            this.$store.dispatch('returnAdIndex');

        },
        updated(){

        },

        computed: mapGetters([
           "allReturnAdIndex",
        ]),

        methods: {
            alertDisplay(status, id) {
                this.$swal({
                    title: '',
                    text: status ? 'Вы уверены, что хотите отключить этот рекламный блок? ' : 'Вы уверены, что хотите включить этот рекламный блок? ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Да',
                    cancelButtonText: 'Отменить',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if(result.value) {
                        this.$store.commit('changeAd', id);
                        this.$store.dispatch('returnAdIndex');
                    }
                })
            },

        },
    }
</script>

<style scoped>

</style>
