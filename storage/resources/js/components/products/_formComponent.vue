<template xmlns="http://www.w3.org/1999/html">
    <div class="form">
        <div class="kt-portlet__body">
            <div class="row">
                <div v-for="(language, index) in languages" class="col-4 " :class="index">
                    <div :class="['form-group', allerros['product_name_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Название элемента ({{language}}) <span>*</span></label>
                        <input type="text" :class="['form-control', allerros['product_name_'+index] ? 'is-invalid' : '']"
                               v-model="form['product_name_'+index]">
                        <div class="invalid-feedback" v-if="allerros['product_name_'+index]" :class="['label label-danger']">{{
                            allerros['product_name_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['product_advantages_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Описание элемента ({{language}})</label>
                        <textarea type="text" :class="['form-control', allerros['product_advantages_'+index] ? 'is-invalid' : '']"
                                  v-model="form['product_advantages_'+index]" rows="3"></textarea>
                        <div class="invalid-feedback" v-if="allerros['product_advantages_'+index]" :class="['label label-danger']">{{
                            allerros['product_advantages_'+index][0] }}
                        </div>
                    </div>
                    <div :class="['form-group', allerros['product_desc_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Преимущества ({{language}})</label>
                        <textarea type="text" :class="['form-control', allerros['product_desc_'+index] ? 'is-invalid' : '']"
                                  v-model="form['product_desc_'+index]" rows="3"></textarea>
                        <div class="invalid-feedback" v-if="allerros['product_desc_'+index]" :class="['label label-danger']">{{
                            allerros['product_desc_'+index][0] }}
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
                <div class="col-12">
                    <label>Цвета *</label>
                    <div class="form-group">
                        <div :class="['form-group', allerros['colors'] ? 'validated' : '']">

                            <v-multiselect-listbox v-if="params.colors"  v-model="form.colors"  :options="params.colors"
                                                   :reduce-display-property="(option) => option.color_name"
                                                   :reduce-value-property="(option) => option.id"
                                                   search-input-class="custom-input-class">
                            </v-multiselect-listbox>
                            <div class="invalid-feedback" v-if="allerros['colors']" :class="['label label-danger']">{{
                                allerros['colors'][0] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['product_type_id'] ? 'validated' : '']">
                        <label>Тип *</label>
                        <select  class="browser-default custom-select" v-model="form['product_type_id']">
                            <option value="">Select</option>
                            <option v-for="type in params.types" :value="type.id">{{ type.type_name}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="allerros['product_type_id']" :class="['label label-danger']">{{
                            allerros['product_type_id'][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div :class="['form-group', allerros['product_category_id'] ? 'validated' : '']">
                        <label>Категория *</label>
                        <select  class="browser-default custom-select" v-model="form['product_category_id']">
                            <option value="">Select</option>
                            <option v-for="item in params.categories" :value="item.id">{{ item.category_name}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="allerros['product_category_id']" :class="['label label-danger']">{{
                            allerros['product_category_id'][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['product_brand_id'] ? 'validated' : '']">
                        <label>Бренд *</label>
                        <select  class="browser-default custom-select" v-model="form['product_brand_id']">
                            <option value="">Select</option>
                            <option v-for="item in params.brands" :value="item.id">{{ item.brand_name}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="allerros['product_brand_id']" :class="['label label-danger']">{{
                            allerros['product_brand_id'][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div :class="['form-group', allerros['product_appointment_id'] ? 'validated' : '']">
                        <label>Назначения *</label>
                        <select  class="browser-default custom-select" v-model="form['product_appointment_id']">
                            <option value="">Select</option>
                            <option v-for="item in params.appointment" :value="item.id">{{ item.appointment_name}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="allerros['product_appointment_id']" :class="['label label-danger']">{{
                            allerros['product_appointment_id'][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['price'] ? 'validated' : '']">
                        <label class="form-control-label">Цена <span>*</span></label>
                        <input type="number" :class="['form-control', allerros['price'] ? 'is-invalid' : '']"
                               v-model="form['price']">
                        <div class="invalid-feedback" v-if="allerros['price']" :class="['label label-danger']">{{
                            allerros['price'][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div :class="['form-group', allerros['product_code'] ? 'validated' : '']">
                        <label class="form-control-label">Product Code </label>
                        <input type="text" :class="['form-control', allerros['product_code'] ? 'is-invalid' : '']"
                               v-model="form['product_code']">
                        <div class="invalid-feedback" v-if="allerros['product_code']" :class="['label label-danger']">{{
                            allerros['product_code'][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div :class="['form-group', allerros['alias'] ? 'validated' : '']">
                        <label class="form-control-label">Псевдоним </label>
                        <input type="text" :class="['form-control', allerros['alias'] ? 'is-invalid' : '']"
                               v-model="form['alias']">
                        <div class="invalid-feedback" v-if="allerros['alias']" :class="['label label-danger']">{{
                            allerros['alias'][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div :class="['form-group', allerros['number_mounting_holes'] ? 'validated' : '']">
                        <label class="form-control-label">number_mounting_holes </label>
                        <input type="number" :class="['form-control', allerros['number_mounting_holes'] ? 'is-invalid' : '']"
                               v-model="form['number_mounting_holes']">
                        <div class="invalid-feedback" v-if="allerros['number_mounting_holes']" :class="['label label-danger']">{{
                            allerros['number_mounting_holes'][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div :class="['form-group', allerros['sale'] ? 'validated' : '']">
                        <label class="form-control-label">Продажа <span>*</span></label>
                        <input type="number" :class="['form-control', allerros['sale'] ? 'is-invalid' : '']"
                               v-model="form['sale']">
                        <div class="invalid-feedback" v-if="allerros['sale']" :class="['label label-danger']">{{
                            allerros['sale'][0] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div>
                    <label class="form-control-label">Best Seller</label>
                </div>
                <div  class="pl-3">
                    <input type="checkbox" v-model="form['best_seller']">
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label>Картинка</label>
                        <div></div>
                        <div class="custom-file">
                            <input type="file" multiple accept="image/*" class="custom-file-input" id="customFile"
                                   @change="handleSelects" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div v-if="form.product_image" class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
                        <div class="kt-avatar__holder">
                            <img :src="form.product_image" alt="img">
                        </div>
                        <a v-if="form.product_image" class="kt-avatar__upload" @click="removeImage()">
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
                <router-link to="/vagart-cms/product-types" type="reset" class="btn btn-secondary">Отмена</router-link>
                <button v-if="id" class="btn btn-danger" @click.prevent="deletePost(id)">Удалить</button>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from "vuex";
    import vMultiselectListbox from 'vue-multiselect-listbox'
    import 'vue-multiselect-listbox/dist/vue-multi-select-listbox.css';

    export default {
        name: "product-types",
        components: {vMultiselectListbox},
        props:['allerros', 'form', 'success', 'languages', 'id'],
        data() {
            return {
                params: [],
            }
        },
        mounted() {

        },
        created() {
            this.$store.dispatch('returnProductsParam');
        },
        updated() {

        },

        computed: mapGetters([
            'allReturnProductsParam'
        ]),

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
                        that.form.product_image = e.target.result;
                    };
                    reader.readAsDataURL(f);
                });
            },
            removeImage(){
                this.form.image = 'remove';
                this.form.product_image = '';
            },
            deletePost(id)
            {
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
                    if(result.value) {
                        let uri = `/products-delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            this.$router.push({name: 'products'});
                            setTimeout(function(){
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
        watch: {
            allReturnProductsParam: function (val) {
                this.params = val
            }
        }
    }
</script>

<style scoped>
    .msl-multi-select {
        display: -webkit-inline-box;
        height: 300px;
        width: 48%;
    }
    .kt-avatar__holder img{
        width: 100%;
    }
</style>
