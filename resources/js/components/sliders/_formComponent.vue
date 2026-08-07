<template xmlns="http://www.w3.org/1999/html">
    <div class="form">
        <div class="kt-portlet__body">
            <div class="row">
                <div v-for="(language, index) in languages" class="col-4 " :class="index">
                    <div :class="['form-group', allerros['slider_name_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Название слайдера ({{language}}) <span>*</span></label>
                        <input type="text" :class="['form-control', allerros['slider_name_'+index] ? 'is-invalid' : '']"
                               v-model="form['slider_name_'+index]">
                        <div class="invalid-feedback" v-if="allerros['slider_name_'+index]"
                             :class="['label label-danger']">{{
                            allerros['slider_name_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['slider_desc_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Описание слайдера ({{language}})</label>
                        <textarea type="text"
                                  :class="['form-control', allerros['slider_desc_'+index] ? 'is-invalid' : '']"
                                  v-model="form['slider_desc_'+index]" rows="3"></textarea>
                        <div class="invalid-feedback" v-if="allerros['slider_desc_'+index]"
                             :class="['label label-danger']">{{
                            allerros['slider_desc_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['slider_button_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Название кнопок ({{language}})</label>
                        <input type="text"
                               :class="['form-control', allerros['slider_button_'+index] ? 'is-invalid' : '']"
                               v-model="form['slider_button_'+index]" rows="3">
                        <div class="invalid-feedback" v-if="allerros['slider_button_'+index]"
                             :class="['label label-danger']">{{
                            allerros['slider_button_'+index][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <label>URL слайдера *</label>
                    <div :class="['form-group', allerros['slider_url'] ? 'validated' : '']">
                        <input type="text" :class="['form-control', allerros['slider_url'] ? 'is-invalid' : '']"
                               v-model="form['slider_url']">
                        <div class="invalid-feedback" v-if="allerros['slider_url']" :class="['label label-danger']">{{
                            allerros['slider_url'][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['slider_image'] ? 'validated' : '']">
                        <label>Картинка *</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="customFile"
                                   @change="handleSelects" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="invalid-feedback" v-if="allerros['slider_image']" :class="['label label-danger']">{{
                            allerros['slider_image'][0] }}
                        </div>
                    </div>
                    <div v-if="form.slider_image" class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
                        <div class="kt-avatar__holder">
                            <img v-if="form.slider_image" :src="form.slider_image" alt="img">
                        </div>
                        <a v-if="form.slider_image" class="kt-avatar__upload" @click="removeImage()">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <span v-if="success" :class="['label label-success']">Record submitted successfully!</span>
            <div class="kt-form__actions">
                <button class="btn btn-primary">Сохранить</button>
                <router-link to="/vagart-cms/slider-types" type="reset" class="btn btn-secondary">Отмена</router-link>
                <button v-if="id" class="btn btn-danger" @click.prevent="deletePost(id)">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "slider-types",
        props: ['allerros', 'form', 'success', 'languages', 'id'],
        data() {
            return {
                params: [],
            }
        },
        methods: {
            handleSelects(e) {
                let fileList = Array.prototype.slice.call(e.target.files);
                this.form.image = e.target.files[0];

                fileList.forEach(f => {
                    if (!f.type.match("image.*")) {
                        return;
                    }
                    let reader = new FileReader();
                    let that = this;

                    reader.onload = function (e) {
                        that.form.slider_image = e.target.result;
                    };
                    reader.readAsDataURL(f);
                });
            },
            removeImage() {
                this.form.image = 'remove';
                this.form.slider_image = '';
                this.form.image = '';
            },
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
                        let uri = `/sliders-delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            this.$router.push({name: 'sliders'});
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
        }
    }
</script>

<style scoped>
    .kt-avatar__holder img {
        width: 100%;
    }
</style>
