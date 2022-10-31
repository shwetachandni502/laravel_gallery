<template>
<div>
    <div class="container m-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header bg-primary text-white">All Records <button class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addRecord"><i class="fa fa-plus"></i></button></div>

                    <div class="card-body">
                        <input type="text" class="form-control mb-3" placeholder="Search By Name" v-model="search" @keyup="searchRecord">

                        <table class="table">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="record in records.data" :key="record.id" class="text-center">
                                    <th v-text="record.id"></th>
                                    <td v-text="record.name"></td>
                                    <td v-text="record.email"></td>
                                    <td v-text="record.phone"></td>
                                    <td v-text="record.img">
                                      
                                    </td>  <img v-bind:src="record.parth" width="100px" />
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#viewRecord" @click="get(record.id)"><i class="fa fa-eye"></i></button>

                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#editRecord" @click="get(record.id)"><i class="fa fa-edit"></i></button>

                                        <button class="btn btn-outline-danger btn-sm" @click="remove(record.id)"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 offset-4 mt-4">
                    <pagination :data="records" v-on:pagination-change-page="getResults"></pagination>
                </div>
            </div>
        </div>

        <div id="modal">
            <Create @recordAdded="refreshRecord"></Create>
            <Edit :editRec="editRec" @recordUpdated="refreshRecord"></Edit>
            <Show :viewRec="editRec"></Show>
        </div>
        
    </div>
    <div class="left-menus">
        
    </div>
    
</div>
</template>

<script>
import Pagination from 'laravel-vue-pagination'

import Show from './Show'
import Edit from './Edit'
import Create from './Create'
export default ({
    setup() {
        
    },
     data() {
            return {
                records: {},
                editRec: [],
                errors: [],
                search: ''
            }
        },
        components:{
            Pagination,Show,Edit,Create
           
        },
         created() {
            axios.get('/pages')
                .then(response => {this.records = response.data; })
                .catch(error => console.log(error))
                
        },
        methods: {
            remove(id) {
               
                   
                        axios.delete(`/pages/${id}`)
                            .then(response => {
                                this.refreshRecord(response);
                            console.log(response)
                              
                            })
                    
                
            },
             getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }

                axios.get(`/pages?page=${page}`)
                    .then(response => this.records = response.data)
                    .catch(error => console.log(error))
            },
            refreshRecord(record) {
                this.records = record.data;
            },
            searchRecord() {
                if (this.search.length >= 1) {
                    axios.get(`/pages/search/${this.search}`)
                        .then(response => this.records = response)
                        .catch(error => console.log(error))
                } else {
                    this.getResults();
                }
            },
            get(id) {
                
                axios.get(`/pages/${id}/edit`)
                    .then(response => this.editRec = response.data[0])
                    .catch(error => this.errors = error.response.data.errors)
                    console.log(this.editRec)
                    
            },
        },
})
</script>

<style scoped>
.left-menus{
    position: relative;
    top:0;
    left:0;
}
</style>

