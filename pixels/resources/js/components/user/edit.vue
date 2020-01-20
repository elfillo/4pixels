<template>
    <div>
        <app-nav></app-nav>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Edit user</div>
                            <div class="card-body">
                                <form @submit.prevent="updateUser">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input
                                                id="name"
                                                type="text"
                                                class="form-control"
                                                v-model="name"
                                                required
                                                autofocus
                                                v-bind:class="{ 'is-invalid': errors.name }"
                                            >
                                            <span v-if='errors.name' class="invalid-feedback" role="alert" style="display: block">
                                                <strong v-for="error in errors.name">
                                                    <span>{{error}}</span>
                                                </strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input
                                                id="email"
                                                type="email"
                                                class="form-control"
                                                v-model="email"
                                                required
                                                v-bind:class="{ 'is-invalid': errors.email }"
                                            >

                                            <span v-if='errors.email' class="invalid-feedback" role="alert" style="display: block">
                                                <strong v-for="error in errors.email">
                                                    <span>{{error}}</span>
                                                </strong>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input
                                                id="password"
                                                type="password"
                                                class="form-control"
                                                v-model="password"
                                                value=""
                                                required
                                                v-bind:class="{ 'is-invalid': errors.password }"
                                            >

                                            <span v-if='errors.password' class="invalid-feedback" role="alert" style="display: block">
                                                <strong v-for="error in errors.password">
                                                    <span>{{error}}</span>
                                                </strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Send
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
    import Nav from "../Nav";
    export default {
        mounted(){
            this.id = this.$route.params.id;
            this.getUser();
        },
        methods:{
            getUser(){
                axios.get('/api/user/'+this.id).then((res) => {
                    this.name = res.data.name;
                    this.email = res.data.email;
                });
            },
            updateUser(){
                this.errors = [];
                axios.put('/api/user/'+this.id,{name: this.name, email:this.email,password:this.password})
                    .then((res) => {
                        if(res.status === 200){
                            this.$router.replace({name: 'user'});
                        }
                    })
                    .catch((error) => {
                        if(error.response.data.errors){
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        },
        data(){
            return{
                name: '',
                email: '',
                password: '',
                errors: [],
                id: '',
            }
        },
        components: {
            AppNav:Nav,
        }
    }
</script>
