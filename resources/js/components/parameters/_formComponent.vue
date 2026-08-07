<template xmlns="http://www.w3.org/1999/html">
    <div class="form">
        <div class="kt-portlet__body">
            <div class="row">
                <div v-for="(language, index) in languages" class="col-4 " :class="index">
                    <div :class="['form-group', allerros['text_'+index] ? 'validated' : '']">
                        <label class="form-control-label">Параметр ({{language}}) <span>*</span></label>
                        <input type="text" :class="['form-control', allerros['text_'+index] ? 'is-invalid' : '']"
                               v-model="form['text_'+index]">
                        <div class="invalid-feedback" v-if="allerros['text_'+index]" :class="['label label-danger']">{{
                            allerros['text_'+index][0] }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <div class="kt-portlet__foot">
            <span v-if="success" :class="['label label-success']">Record submitted successfully!</span>
            <div class="kt-form__actions">
                <button class="btn btn-primary">Сохранить</button>
<!--                <button v-if="id" class="btn btn-danger" @click.prevent="deletePost(id)">Удалить</button>-->
                <router-link to="/vagart-cms/parameters" type="reset" class="btn btn-secondary">Отмена</router-link>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapGetters} from "vuex";

    export default {
        name: "quickSearch",
        components: {},
        props:['allerros', 'form', 'success', 'languages', 'id'],
        data() {
            return {
            }
        },
        mounted() {

        },
        created() {

        },
        updated() {

        },

        computed: mapGetters([
        ]),

        methods: {
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
                        let uri = `/parameters-delete/${id}`;
                        this.axios.delete(uri).then(response => {
                            this.$router.push({name: 'parameters'});
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
        }
    }
</script>

<style scoped>

</style>
