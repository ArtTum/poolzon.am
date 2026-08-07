<template xmlns="http://www.w3.org/1999/html">
    <div class="form">
        <div class="kt-portlet__body">
            <div class="row">
                <div v-for="(language, index) in languages" class="col-4 " :class="index">
                    <div :class="['form-group', allerros['our_project_name_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Название  ({{language}}) <span>*</span></label>
                        <input type="text"
                               :class="['form-control', allerros['our_project_name_'+index] ? 'is-invalid' : '']"
                               v-model="form['our_project_name_'+index]">
                        <div class="invalid-feedback" v-if="allerros['our_project_name_'+index]"
                             :class="['label label-danger']">{{
                                allerros['our_project_name_'+index][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['image'] ? 'validated' : '']">
                        <label>Картинка *</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" accept="image/*" class="custom-file-input" id="customFile"
                                   @change="handleSelects" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <div class="invalid-feedback" v-if="allerros['image']" :class="['label label-danger']">{{
                            allerros['image'][0] }}
                        </div>
                    </div>
                    <div v-if="form.image" class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
                        <div class="kt-avatar__holder">
                            <img v-if="form.image" :src="form.image" alt="img">
                        </div>
                        <a v-if="form.image" class="kt-avatar__upload" @click="removeImage()">
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
                <router-link to="/vagart-cms/our-projects" type="reset" class="btn btn-secondary">Отмена</router-link>
                <button v-if="id" class="btn btn-danger" @click.prevent="deletePost(id)">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "our-projects",
        props: ['allerros', 'form', 'success', 'languages', 'id'],
        data() {
            return {
                params: [],
            }
        },
        methods: {
            handleSelects(e) {
                let fileList = Array.prototype.slice.call(e.target.files);
                this.form.image2 = e.target.files[0];

                fileList.forEach(f => {
                    if (!f.type.match("image.*")) {
                        return;
                    }
                    let reader = new FileReader();
                    let that = this;

                    reader.onload = function (e) {
                        that.form.image = e.target.result;
                    };
                    reader.readAsDataURL(f);
                });
            },
            removeImage() {
                this.form.image2 = 'remove';
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
                        let uri = `/our-projects-delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            this.$router.push({name: 'our-projects'});
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
