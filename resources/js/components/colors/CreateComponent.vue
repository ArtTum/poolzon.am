<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Добавить новый цвет</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/colors" class="kt-subheader__breadcrumbs-home">Цвета</router-link>
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
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect> <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect> <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" fill="#000000" opacity="0.3"></path></g></svg>
                                </span>
                                <h3 class="kt-portlet__head-title">
                                    Параметры цвет
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="/colors-store"  class="form-horizontal" @submit.prevent="onSubmit"  enctype="multipart/form-data">
                            <colors-form :allerros="allerros" :form="form" :success="success" :languages="languages"></colors-form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </div>

</template>

<script>
    export default {
        name: "TypesCreate",
        data() {
            return {
                form: {
                    color_name_am: '',
                    color_name_ru : '',
                },
                allerros: [],
                success : false,
                formData: new FormData(),
                languages: {'am':'арм', 'ru': 'рус'},
            }
        },
        methods : {
            onSubmit() {
                Vue.axios.post('/colors-store', {
                    color_name_am: this.form.color_name_am,
                    color_name_ru: this.form.color_name_ru
                }).then( response => {
                    this.allerros = [];
                    this.success = true;
                    if (this.success){
                        this.$router.push({name: 'colors'});
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
