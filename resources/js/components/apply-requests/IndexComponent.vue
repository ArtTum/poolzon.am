<template>
    <div class="kt-content min-height  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Рекламный блок </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <router-link to="/vagart-cms/dashboard" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></router-link>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <router-link to="" class="kt-subheader__breadcrumbs-link">
                            Рекламный блок
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
                                    Список рекламных блок
                                </h3>

                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-wrapper">
                                    <div class="kt-portlet__head-actions">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div id="app" class="container">
                                <h3 class="mt-3">Add User</h3>
                                <hr>
                                <div class="row">
                                    <div class="col">

                                        <label>User ID</label>
                                        <input type="number" class="form-control" v-model="id">
                                    </div>
                                    <div class="col">

                                        <label>User name</label>
                                        <input type="text" class="form-control" v-model="name">
                                    </div>
                                    <div class="col">

                                        <label>User Email</label>
                                        <input type="text" class="form-control" v-model="email">
                                    </div>

                                </div>
                                <button class="btn btn-info mt-2" @click="addUser">Add User</button>
                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <button  data-log-id="10" class="logMe">'+user.name+'</button>
                                        <table id="user-table" class="display table-bordered nowrap" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>User Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end:: Content -->
    </div>

</template>

<script>
    import draggable from "vuedraggable";

    import {mapGetters} from "vuex";
    function clickRow(){
        alert(5656);
    }
    export default {
        name: "AdBlocks",
        components: {
            draggable
        },
        data() {
            return {
                id:'',
                name:'',
                email:'',
                dataTable:null,
            }
        },
        methods:{
            logData(id) {
                console.log(id);
            },
            addUser(){

                this.dataTable.row.add([
                    this.id,
                    '<router-link :to="/">'+this.name+'</router-link>',
                    this.email
                ]).draw(false)
                this.id='';
                this.name='';
                this.email='';
            }
        },
        mounted(){
            let users = [];

            this.dataTable = $('#user-table').DataTable({
                paging: false,
                searching: false,
            });

            $('.logMe').on('click', (evt) => {
                console.log("called")
                const data = $(evt.target).data('logId');
                this.logData(data);
            });

            $("body").delegate(".logMe", "click", (evt) =>{
                console.log("called")
                const data = $(evt.target).data('logId');
                this.logData(data);
            });

            const url = 'https://jsonplaceholder.typicode.com/users';
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    data.forEach(item => {
                        users.push(item);
                    });

                    users.forEach(user=>{
                        this.dataTable.row.add([
                            user.id,
                            '         <button  data-log-id="10" class="logMe">'+user.name+'</button>',
                            user.email
                        ]).draw(false)
                    })
                })
        }
    }
</script>

<style scoped>

</style>
