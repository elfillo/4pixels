<template>
    <div>
        <app-nav></app-nav>
        <main class="py-4">
            <div class="container border rounded-lg">
                <div class="row border-bottom">
                    <div class="col-12 d-flex justify-content-between align-items-center bg-light">
                        Users
                        <router-link :to="{ name: 'user.create' }" class="btn btn-primary m-2">Add</router-link>
                    </div>
                </div>
                <div class="container">
                    <div v-for="user in users" class="row border-top mt-4 d-flex justify-content-between align-items-center pt-2 pb-2">
                        <div class="col-3">{{ user.name }}</div>
                        <div class="col-3">{{ user.email }}</div>
                        <div class="col-3">{{ user.created_at }}</div>
                        <div class="col-3">
                            <router-link :to="{ name: 'user.edit', params: { id: user.id }}" class="btn btn-secondary m-2">Edit</router-link>
                            <div class="btn btn-danger" v-on:click="deleteUser(user.id)">Delete</div>
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
            this.getUsers();
        },
        methods: {
            getUsers(){
                axios.get('api/user').then((res)=>{
                    this.users = res.data.data;
                    this.last_page = res.data.last_page;
                    this.current_page = res.data.current_page;
                    this.next_page_url = res.data.next_page_url;
                    this.prev_page_url = res.data.prev_page_url;
                })
            },
            deleteUser(id){
                axios.delete('api/user/'+id).then((res)=>{
                    this.users = res.data.data;
                    this.last_page = res.data.last_page;
                    this.current_page = res.data.current_page;
                    this.next_page_url = res.data.next_page_url;
                    this.prev_page_url = res.data.prev_page_url;
                })
            },
            getNextPage(){
                axios.get(this.next_page_url).then((res)=>{
                    this.users = res.data.data;
                    this.last_page = res.data.last_page;
                    this.updatePageInfo(res.data);
                })
            },
            getPrevPage(){
                axios.get(this.prev_page_url).then((res)=>{
                    this.users = res.data.data;
                    this.updatePageInfo(res.data);
                })
            },
            getPage(page){
                axios.get('api/user?page='+page).then((res)=>{
                    this.users = res.data.data;
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
                users: [],
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
