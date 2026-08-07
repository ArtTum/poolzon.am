<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Редактировать продукт </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/product-types" class="kt-subheader__breadcrumbs-home">Продукты
                        </router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Редактировать
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
                                    Параметры продукта
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="loader" class="swal2-container swal2-center swal2-shown">
                            <div style="display: flex; justify-content: center;">
                                <clip-loader :color="color" :size="size"></clip-loader>
                            </div>
                        </div>

                        <form method="POST" class="form-horizontal" @submit.prevent="onSubmit"
                              enctype="multipart/form-data">
                            <product-form v-if="form.success" :allerros="allerros" :form="form" :success="success" :languages="languages"
                                          :id="id"></product-form>
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
    import ClipLoader from "vue-spinner/src/ClipLoader.vue";

    export default {

        name: "ProductTypesUpdate",
        components: {
            ClipLoader
        },
        data() {
            return {
                color: '#3085d6',
                size: '80px',
                loader: false,
                id: this.$router.currentRoute.params['id'],
                form: {
                    colors: [],
                    product_image: '',
                    image: '',
                    product_type_id: '',
                    product_category_id: '',
                    product_appointment_id: '',
                    product_brand_id: '',
                    product_name_am: '',
                    product_name_ru: '',
                    product_desc_am: '',
                    product_desc_ru: '',
                    product_advantages_am: '',
                    product_advantages_ru: '',
                    meta_title_am: '',
                    meta_title_ru: '',
                    meta_keywords_am: '',
                    meta_keywords_ru: '',
                    meta_desc_am: '',
                    meta_desc_ru: '',
                    number_mounting_holes: '',
                    sale: '',
                    price: '',
                    alias: '',
                    product_code: '',
                    product_count: '',
                    best_seller: false,
                    success: false,
                },
                allerros: [],
                success: false,
                formData: new FormData(),
                languages: {'am': 'арм', 'ru': 'рус'},
            }
        },
        mounted() {

        },

        beforeCreate() {
            this.$store.commit('changeProductsGet', this.$route.params.id);
            this.$store.dispatch('returnProductsGet');
        },
        computed: mapGetters([
            "allReturnProductsGet",
        ]),
        methods: {
            onSubmit() {
                this.loader = true;
                this.formData.append('product_id', this.id);
                this.formData.append('product_name_am', this.form.product_name_am);
                this.formData.append('meta_title_am', this.form.meta_title_am);
                this.formData.append('meta_keywords_am', this.form.meta_keywords_am);
                this.formData.append('meta_desc_am', this.form.meta_desc_am);
                this.formData.append('product_desc_am', this.form.product_desc_am);
                this.formData.append('meta_title_ru', this.form.meta_title_ru);
                this.formData.append('meta_keywords_ru', this.form.meta_keywords_ru);
                this.formData.append('meta_desc_ru', this.form.meta_desc_ru);
                this.formData.append('best_seller', this.form.best_seller);
                this.formData.append('price', this.form.price);
                this.formData.append('product_code', this.form.product_code);
                this.formData.append('product_count', this.form.product_count);
                this.formData.append('sale', this.form.sale);
                this.formData.append('number_mounting_holes', this.form.number_mounting_holes);
                this.formData.append('product_name_ru', this.form.product_name_ru);
                this.formData.append('product_desc_ru', this.form.product_desc_ru);
                this.formData.append('product_advantages_am', this.form.product_advantages_am);
                this.formData.append('product_advantages_ru', this.form.product_advantages_ru);
                this.formData.append('product_category_id', this.form.product_category_id);
                this.formData.append('product_appointment_id', this.form.product_appointment_id);
                this.formData.append('product_brand_id', this.form.product_brand_id);
                this.formData.append('product_type_id', this.form.product_type_id);
                this.formData.append('product_image', this.form.product_image);
                this.formData.append('product_image', this.form.image);
                this.formData.append('alias', this.form.alias);
                this.formData.append('colors', this.form.colors.length ? JSON.stringify(this.form.colors) : '');



                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                }

                Vue.axios.post('/products-update/' + this.$route.params.id, this.formData, config).then(response => {
                    if (response.data.form) {
                        this.$router.push({name: 'products'});
                        setTimeout(function () {
                            Swal.fire({
                                position: 'top-end',
                                imageUrl: '/images/success.gif',
                                imageWidth: 60,
                                title: 'Вы успешно сохранили этот элемент',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }, 500);
                    }
                    this.loader = false;
                }).catch((error) => {
                    this.allerros = error.response.data.errors;
                    this.success = false;
                    this.loader = false;
                });
            },
        },
        watch: {
            allReturnProductsGet: function (val) {
                let arm = 0;
                let rus = 1;
                this.form.product_name_am = val.form.lang[arm].product_name;
                this.form.product_desc_am = val.form.lang[arm].description;
                this.form.product_advantages_am = val.form.lang[arm].advantages;
                this.form.meta_title_am = val.form.lang[arm].meta_title;
                this.form.meta_keywords_am = val.form.lang[arm].meta_keys;
                this.form.meta_desc_am = val.form.lang[arm].meta_description;

                this.form.product_name_ru = val.form.lang[rus].product_name;
                this.form.product_desc_ru = val.form.lang[rus].description;
                this.form.product_advantages_ru = val.form.lang[rus].advantages;
                this.form.meta_title_ru = val.form.lang[rus].meta_title;
                this.form.meta_keywords_ru = val.form.lang[rus].meta_keys;
                this.form.meta_desc_ru = val.form.lang[rus].meta_description;

                this.form.product_image = val.form.product_image ? '/uploads/products/' + val.form.product_image : '';
                this.form.product_type_id = val.form.types_id;
                this.form.product_brand_id = val.form.brand_id;
                this.form.product_category_id = val.form.category_id;
                this.form.product_appointment_id = val.form.appointment_id;
                this.form.alias = val.form.alias;
                this.form.price = val.form.price;
                this.form.sale = val.form.sale;
                this.form.best_seller = val.form.bestseller == 0 ? false : true;
                this.form.number_mounting_holes = val.form.number_mounting_holes;
                this.form.product_code = val.form.product_code;
                this.form.product_count = val.form.product_count;
                this.form.colors = val.colors;
                this.form.success = true;
            }
        }
    }
</script>

<style scoped>

</style>
