<template xmlns="http://www.w3.org/1999/html">
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Редактировать Наши проекты </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="/vagart-cms/banner-types" class="kt-subheader__breadcrumbs-home">Наши проекты
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
                                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect> <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3"></path> <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000"></path></g></svg>
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
                        <div v-if="loader" class="swal2-container swal2-center swal2-shown">
                            <div style="display: flex; justify-content: center;">
                                <clip-loader :color="color" :size="size"></clip-loader>
                            </div>
                        </div>
                        <form method="POST" class="form-horizontal" @submit.prevent="onSubmit"
                              enctype="multipart/form-data">
                            <our-projects-form :allerros="allerros" :form="form" :languages="languages" :success="success"
                                         :id="id"></our-projects-form>
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

        name: "ourProjectsUpdate",
        components: {
            ClipLoader
        },
        data() {
            return {
                id: this.$route.params.id,
                color: '#3085d6',
                size: '80px',
                loader: false,
                form: {
                    image: '',
                    image2: '',
                    our_project_name_am: '',
                    our_project_name_ru : '',
                },
                allerros: [],
                success: false,
                formData: new FormData(),
                languages: {'am':'арм', 'ru': 'рус'},
            }
        },
        created() {
            this.$store.dispatch('returnOurProjectsGet', {id: this.id}).then(response => {

                let arm = 0;
                let rus = 1;
                this.form.our_project_name_am = response.ourProject.lang[arm].our_project_name;
                this.form.our_project_name_ru = response.ourProject.lang[rus].our_project_name;
                this.form.title = response.ourProject.title;
                 this.form.image = response.ourProject.image ?  '/uploads/our-projects/' + response.ourProject.image : '';

                console.log(response);
            });
        },
        methods: {
            onSubmit() {
                this.loader = true;
                this.formData.append('id', this.id);
                this.formData.append('our_project_name_am', this.form.our_project_name_am);
                this.formData.append('our_project_name_ru', this.form.our_project_name_ru);
                this.formData.append('image', this.form.image);
                this.formData.append('image', this.form.image2);
                const config = {
                    headers: {'content-type': 'multipart/form-data'}
                };

                Vue.axios.post('/our-projects-update', this.formData, config).then(response => {
                    this.allerros = [];
                    this.success = true;
                    if (this.success) {
                        this.$router.push({name: 'our-projects'});
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
                        this.loader = false;
                    }
                }).catch((error) => {
                    this.allerros = error.response.data.errors;
                    this.success = false;
                    this.loader = false;
                });
            }
        },
        watch: {
            $route(toR) {
                this.id = toR.params['id']
            },
        },
    }
</script>

<style scoped>

</style>
