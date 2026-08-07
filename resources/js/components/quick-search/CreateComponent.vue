<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Добавить новый элемент быстрого поиска </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/quick-search" class="kt-subheader__breadcrumbs-home">Быстрый поиск</router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Добавить
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
                                    Параметры элемента быстрого поиска
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="/quick-search-store"  class="form-horizontal" @submit.prevent="onSubmit"  enctype="multipart/form-data">
                            <quick-search-form :allerros="allerros" :form="form" :success="success" :languages="languages"></quick-search-form>
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

        name: "quickSearchCreate",
        components: {
        },
        data() {
            return {
                form: {
                    quick_search_name_am: '',
                    quick_search_name_ru : '',
                    quick_search_name_en : '',
                    quick_search_alias_am : '',
                    quick_search_alias_ru : '',
                    quick_search_alias_en : '',
                },
                allerros: [],
                success : false,
                formData: new FormData(),
                languages: {'am':'арм', 'ru': 'рус', 'en': 'анг'},
            }
        },
        computed: mapGetters([
        //    "allCategoryCreate",
        ]),
        methods : {
            onSubmit() {

                this.formData.append('quick_search_name_am', this.form.quick_search_name_am);
                this.formData.append('quick_search_name_ru', this.form.quick_search_name_ru);
                this.formData.append('quick_search_name_en', this.form.quick_search_name_en);

                this.formData.append('quick_search_alias_am', this.form.quick_search_alias_am);
                this.formData.append('quick_search_alias_ru', this.form.quick_search_alias_ru);
                this.formData.append('quick_search_alias_en', this.form.quick_search_alias_en);

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                Vue.axios.post('/quick-search-store', this.formData, config).then( response => {
                    this.allerros = [];
                    this.success = true;
                    if (this.success){
                        this.$router.push({name: 'quick-search'});
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
                } ).catch((error) => {
                    this.allerros = error.response.data.errors;
                    this.success = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>
