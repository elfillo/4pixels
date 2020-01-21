<template>
    <div>
        <app-nav></app-nav>
        <main class="py-4">
            <div class="container border rounded-lg">
                <div class="row border-bottom">
                    <div class="col-12 d-flex justify-content-between align-items-center bg-light">
                        Departments
                        <router-link :to="{ name: 'department.create' }" class="btn btn-primary m-2">Add</router-link>
                    </div>
                </div>
                <div class="container">
                    <div v-for="department in departments" class="row border-top mt-4 d-flex justify-content-between align-items-center pt-2 pb-2">
                        <div class="col-2 border department-logo__list">
                            <img :src="'/logo/' + department.logo" alt="#">
                        </div>
                        <div class="col-4">
                            <p class="font-weight-bold" style="text-transform: capitalize">{{ department.name }}</p>
                            <span>{{ department.description}}</span>
                        </div>
                        <div class="col-4">
                            <p class="font-weight-bold">Users</p>
                            <ol>
                                <li v-for="user in department.users">{{ user.name }}</li>
                            </ol>
                        </div>
                        <div class="col-2">
                            <router-link :to="{ name: 'department.edit', params: { id: department.id }}" class="btn btn-secondary m-2">Edit</router-link>
                            <div class="btn btn-danger" v-on:click="deleteDepartment(department.id)">Delete</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item" v-on:click="getPrevPage"><a class="page-link" style="cursor: pointer"><<</a></li>

                                <li class="page-item d-flex" v-for="page in last_page" :key="page"  v-bind:class="{ active: page == current_page }" style="cursor: pointer">
                                    <a class="page-link" v-on:click="getPage(page)">{{page}}</a>
                                </li>
                                <li class="page-item" v-on:click="getNextPage"><a class="page-link" style="cursor: pointer">>></a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
    import Nav from "../Nav";
    export default {
        mounted() {
            this.getDepartments();
        },
        methods: {
            getDepartments(){
                axios.get('api/department').then((res)=>{
                    this.departments = res.data.data;
                    this.last_page = res.data.last_page;
                    this.current_page = res.data.current_page;
                    this.next_page_url = res.data.next_page_url;
                    this.prev_page_url = res.data.prev_page_url;
                })
            },
            deleteDepartment(id){
                axios.delete('api/department/'+id).then((res)=>{
                    this.departments = res.data.data;
                    this.last_page = res.data.last_page;
                    this.current_page = res.data.current_page;
                    this.next_page_url = res.data.next_page_url;
                    this.prev_page_url = res.data.prev_page_url;
                })
            },
            getNextPage(){
                axios.get(this.next_page_url).then((res)=>{
                    this.departments = res.data.data;
                    this.last_page = res.data.last_page;
                    this.updatePageInfo(res.data);
                })
            },
            getPrevPage(){
                axios.get(this.prev_page_url).then((res)=>{
                    this.departments = res.data.data;
                    this.updatePageInfo(res.data);
                })
            },
            getPage(page){
                axios.get('api/department?page='+page).then((res)=>{
                    this.departments = res.data.data;
                    this.updatePageInfo(res.data);
                })
            },
            updatePageInfo(data){
                this.current_page = data.current_page;
                this.next_page_url = data.next_page_url;
                this.prev_page_url = data.prev_page_url;
            }
        },
        data(){
            return {
                departments: [],
                last_page: null,
                current_page: null,
                next_page_url: null,
                prev_page_url: null,

            }
        },
        components: {
            AppNav:Nav,
        }
    }
</script>
<style :scoped>
    .department-logo__list{
        overflow: hidden;
        width: 150px;
        height: 150px;
        background-size: cover;
        background-position: center;
        padding: 0;
    }
    .department-logo__list img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
