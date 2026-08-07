<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Редактировать рекламный блок </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/ad-blocs" class="kt-subheader__breadcrumbs-home">Рекламный блок</router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Редактировать рекламный блок
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
                                    Параметры блока
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form @submit.prevent="addPost">
                            <div class="kt-portlet__body">
                                <div class="form-group">
                                    <label>Название блока</label>
                                    <input type="text" class="form-control" v-model="allReturnAdGet.ad_block_name">
                                    <div style="display: block" class="invalid-feedback">{{ errors.get('ad_block_name')}}</div>
                                </div>
                                <div class="form-group form-group-last">
                                    <label for="exampleTextarea">Код блока </label>
                                    <textarea class="form-control" id="exampleTextarea" rows="3" v-model="allReturnAdGet.ad_block_code"></textarea>
                                    <div style="display: block" class="invalid-feedback">{{ errors.get('ad_block_code')}}</div>
                                </div>
                            </div>
                            <div class="kt-portlet__foot">
                                <div class="kt-form__actions">
                                    <button class="btn btn-primary">Сохранить</button>
                                    <router-link to="/vagart-cms/ad-blocs" type="reset" class="btn btn-secondary">Отмена</router-link>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
        <!-- end:: Content -->
    </div>

</template>

<script>
    import {mapGetters} from "vuex";
    class Errors {
        constructor() {
            this.errors = {};
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }
        record(errors) {
            this.errors = errors.errors;
        }
    }

    export default {
        name: "AdBlocks",
        components: {
        },
        data() {
            return {
                ad_block_name: '',
                ad_block_code: '',
                post: {id:this.$router.currentRoute.params['id']},
                errors: new Errors(),
                id: this.$router.currentRoute.params['id'],
                items: []
            }
        },
        mounted() {


        },
        created(){

            this.$store.commit('changeAdGet', this.post);
            this.$store.dispatch('returnAdGet');
        },
        updated(){

        },

        computed: mapGetters([
            "allReturnAdEdit",
            "allReturnAdGet",
        ]),

        methods: {
            addPost() {
                this.post = this.allReturnAdGet;
                this.$store.commit('changeAdEdit', this.post);
                this.$store.dispatch('returnAdEdit');
            },
        },
        watch: {
            $route(toR, fromR) {
                this.id = toR.params['id'];
            },
            allReturnAdEdit: function (val) {
                this.items = val;

                if (this.items.success){
                    setTimeout(function(){
                        Swal.fire({
                            position: 'top-end',
                            imageUrl: '/images/success.gif',
                            imageWidth: 60,
                            title: 'Вы успешно сохранили этот элемент',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }, 500);
                    this.$router.push({name: 'ad-blocs'});
                }

                if (this.items.errors){

                    this.errors.record(this.items);
                }
            }
        }
    }
</script>

<style scoped>

</style>
