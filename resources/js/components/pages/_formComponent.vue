<template xmlns="http://www.w3.org/1999/html">
    <div class="form">
        <div class="kt-portlet__body">
            <div class="row">
                <div v-for="(language, index) in languages" class="col-4 " :class="index">
                    <div :class="['form-group', allerros['page_name_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Название страницы ({{language}}) <span>*</span></label>
                        <input type="text"
                               :class="['form-control', allerros['page_name_'+index] ? 'is-invalid' : '']"
                               v-model="form['page_name_'+index]">
                        <div class="invalid-feedback" v-if="allerros['page_name_'+index]"
                             :class="['label label-danger']">{{
                            allerros['page_name_'+index][0] }}
                        </div>
                    </div>

                    <div style="height: 400px" :class="['form-group', allerros['page_desc_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Տեքստ ({{language}})<span>*</span></label>
                        <ckeditor :class="['', allerros['page_desc_'+index] ? 'is-invalid' : '']"
                                  v-model="form['page_desc_'+index]" ></ckeditor>
                        <div class="invalid-feedback" v-if="allerros['page_desc_'+index]" :class="['label label-danger']">{{
                            allerros['page_desc_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['meta_title_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Мета Title ({{language}})<span>*</span></label>
                        <input type="text" :class="['form-control', allerros['meta_title_'+index] ? 'is-invalid' : '']"
                               v-model="form['meta_title_'+index]">
                        <div class="invalid-feedback" v-if="allerros['meta_title_'+index]"
                             :class="['label label-danger']">{{
                            allerros['meta_title_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['meta_keywords_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Мета Keywords ({{language}})<span>*</span></label>
                        <input type="text"
                               :class="['form-control', allerros['meta_keywords_'+index] ? 'is-invalid' : '']"
                               v-model="form['meta_keywords_'+index]">
                        <div class="invalid-feedback" v-if="allerros['meta_keywords_'+index]"
                             :class="['label label-danger']">{{
                            allerros['meta_keywords_'+index][0] }}
                        </div>
                    </div>

                    <div :class="['form-group', allerros['meta_desc_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Мета Description ({{language}})<span>*</span></label>
                        <textarea type="text"
                                  :class="['form-control', allerros['meta_desc_'+index] ? 'is-invalid' : '']"
                                  v-model="form['meta_desc_'+index]" rows="3"></textarea>
                        <div class="invalid-feedback" v-if="allerros['meta_desc_'+index]"
                             :class="['label label-danger']">{{
                            allerros['meta_desc_'+index][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>Псевдоним *</label>
                    <div :class="['form-group', allerros['page_alias'] ? 'validated' : '']">
                        <input type="text" :class="['form-control', allerros['page_alias'] ? 'is-invalid' : '']"
                               v-model="form['page_alias']">
                        <div class="invalid-feedback" v-if="allerros['page_alias']" :class="['label label-danger']">
                            {{
                            allerros['page_alias'][0] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <span v-if="success" :class="['label label-success']">Record submitted successfully!</span>
            <div class="kt-form__actions">
                <button class="btn btn-primary">Сохранить</button>
                <button v-if="id" class="btn btn-danger" @click.prevent="deletePost(id)">Удалить</button>
                <router-link to="/vagart-cms/pages" type="reset" class="btn btn-secondary">Отмена</router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pages",
        props: ['allerros', 'form', 'success', 'languages', 'id'],
        methods: {
            deletePost(id) {
                this.$swal({
                    title: 'Вы уверены?',
                    text: 'Вы не можете отменить свое действие',
                    type: 'предупреждение',
                    showCancelButton: true,
                    confirmButtonText: 'Да, удали это!',
                    cancelButtonText: 'Нет, держи это!',
                    showCloseButton: true,
                    showLoaderOnConfirm: true
                }).then((result) => {
                    if (result.value) {
                        let uri = `/pages-delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            this.$router.push({name: 'pages'});
                            setTimeout(function () {
                                Swal.fire({
                                    position: 'top-end',
                                    imageUrl: '/images/success.gif',
                                    imageWidth: 60,
                                    title: 'Вы успешно удалили этот элемент',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }, 500);
                        });
                    }
                })
            }
        },
    }
</script>

<style scoped>
    .kt-avatar__holder img {
        width: 100%;
    }
</style>
