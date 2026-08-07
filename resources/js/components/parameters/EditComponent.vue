<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Редактировать Параметры </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/parameters" class="kt-subheader__breadcrumbs-home">Параметры</router-link>
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
                                    Параметры
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" class="form-horizontal" @submit.prevent="onSubmit" enctype="multipart/form-data">
                            <parameters-form :allerros="allerros" :form="form" :success="success" :languages="languages" :id="id"></parameters-form>
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

    export default {

        name: "parametersUpdate",
        components: {},
        data() {
            return {
                id: this.$router.currentRoute.params['id'],
                form: {
                    text_am: '',
                    text_ru : '',
                    text_en : '',
                },
                allerros: [],
                success: false,
                formData: new FormData(),
                languages: {'am': 'арм', 'ru': 'рус'},
            }
        },
        mounted() {

        },
        created() {
           this.getData();
        },
        computed: mapGetters([
    //        "allCategoryEdit",
        ]),
        methods: {
            onSubmit() {
                this.formData.append('text_am', this.form.text_am);
                this.formData.append('text_ru', this.form.text_ru);

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                Vue.axios.post('/parameters-update/'+this.$route.params.id, this.formData, config).then(response => {
                    if (response.data.form) {
                        this.$router.push({name: 'parameters'});
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
                    }
                }).catch((error) => {
                    this.allerros = error.response.data.errors;
                    this.success = false;
                });
            },
            getData() {
                let uri = `/parameters-edit/${this.$route.params.id}`;
                this.axios.post(uri).then((response) => {
                    if (response.data.form){
                        let arm = response.data.form.lang[0];
                        let rus = response.data.form.lang[1];

                        this.form.text_am = arm.text;
                        this.form.text_ru = rus.text;
                    }
                });
            },
        },
        watch: {
            allCategoryEdit: function (val) {
            }

        }
    }
</script>

<style scoped>

</style>
