<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Добавить новий бренд </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/brands" class="kt-subheader__breadcrumbs-home">Бренд</router-link>
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
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect> <path d="M10.5,5 L19.5,5 C20.3284271,5 21,5.67157288 21,6.5 C21,7.32842712 20.3284271,8 19.5,8 L10.5,8 C9.67157288,8 9,7.32842712 9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,10 L19.5,10 C20.3284271,10 21,10.6715729 21,11.5 C21,12.3284271 20.3284271,13 19.5,13 L10.5,13 C9.67157288,13 9,12.3284271 9,11.5 C9,10.6715729 9.67157288,10 10.5,10 Z M10.5,15 L19.5,15 C20.3284271,15 21,15.6715729 21,16.5 C21,17.3284271 20.3284271,18 19.5,18 L10.5,18 C9.67157288,18 9,17.3284271 9,16.5 C9,15.6715729 9.67157288,15 10.5,15 Z" fill="#000000"></path> <path d="M5.5,8 C4.67157288,8 4,7.32842712 4,6.5 C4,5.67157288 4.67157288,5 5.5,5 C6.32842712,5 7,5.67157288 7,6.5 C7,7.32842712 6.32842712,8 5.5,8 Z M5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 C6.32842712,10 7,10.6715729 7,11.5 C7,12.3284271 6.32842712,13 5.5,13 Z M5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 C6.32842712,15 7,15.6715729 7,16.5 C7,17.3284271 6.32842712,18 5.5,18 Z" fill="#000000" opacity="0.3"></path></g></svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Параметры Бренда
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="/brands-store"  class="form-horizontal" @submit.prevent="onSubmit"  enctype="multipart/form-data">
                            <brands-form :allerros="allerros" :form="form" :success="success" :languages="languages"></brands-form>
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

        name: "BrandsCreate",
        components: {
        },
        data() {
            return {
                form: {
                    brand_image: '',
                    image: '',
                    page_alias : '',
                    brand_name_am: '',
                    brand_name_ru : '',
                    meta_title_am : '',
                    meta_title_ru : '',
                    meta_keywords_am : '',
                    meta_keywords_ru : '',
                    meta_desc_am : '',
                    meta_desc_ru : '',
                },
                allerros: [],
                success : false,
                formData: new FormData(),
                languages: {'am':'арм', 'ru': 'рус'},
            }
        },
        methods : {
            onSubmit() {
                this.formData.append('brand_name_am', this.form.brand_name_am);
                this.formData.append('brand_name_ru', this.form.brand_name_ru);

                this.formData.append('page_alias', this.form.page_alias);

                this.formData.append('meta_title_am', this.form.meta_title_am);
                this.formData.append('meta_title_ru', this.form.meta_title_ru);

                this.formData.append('meta_keywords_am', this.form.meta_keywords_am);
                this.formData.append('meta_keywords_ru', this.form.meta_keywords_ru);

                this.formData.append('meta_desc_am', this.form.meta_desc_am);
                this.formData.append('meta_desc_ru', this.form.meta_desc_ru);

                this.formData.append('brand_image', this.form.brand_image);
                this.formData.append('brand_image', this.form.image);
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };

                Vue.axios.post('/brands-store', this.formData, config).then( response => {
                    this.allerros = [];
                    this.success = true;
                    if (this.success){
                        this.$router.push({name: 'brands'});
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
