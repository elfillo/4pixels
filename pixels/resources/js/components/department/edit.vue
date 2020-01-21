<template>
    <div>
        <app-nav></app-nav>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">Create department</div>
                            <div class="card-body">
                                <form @submit.prevent="updateDepartment">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-12 col-form-label text-md-left">Name</label>

                                        <div class="col-md-12">
                                            <input
                                                id="name"
                                                v-model="name"
                                                type="text"
                                                class="form-control"
                                                v-bind:class="{ 'is-invalid': errors.name }"
                                                required autocomplete="name" autofocus
                                            >

                                            <span v-if='errors.name' class="invalid-feedback" role="alert" style="display: block">
                                                <strong v-for="error in errors.name">
                                                    <span>{{error}}</span>
                                                </strong>
                                            </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="description" class="col-md-12 col-form-label text-md-left">Description</label>

                                        <div class="col-md-12">
                                    <textarea
                                        class="form-control"
                                        v-bind:class="{ 'is-invalid': errors.description }"
                                        v-model="description"
                                        id="description" cols="30" rows="10"
                                    >
                                        {{ description }}
                                    </textarea>

                                            <span v-if='errors.description' class="invalid-feedback" role="alert" style="display: block">
                                        <strong v-for="error in errors.description">
                                            <span>{{error}}</span>
                                        </strong>
                                    </span>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="logo" class="col-md-12 col-form-label text-md-left">Logo</label>
                                        <div class="col-2 border department-logo__list p-2 mb-2 ml-2">
                                            <img :src="'/logo/' + logo" alt="#" v-if="logo">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input
                                                    type="file"
                                                    value=""
                                                    class="border rounded form-control-file"
                                                    v-bind:class="{ 'is-invalid': errors.description }"
                                                    ref="file"
                                                    v-on:change="handleFileUpload()"
                                                    id="logo"
                                                >

                                                <span v-if='errors.logo' class="invalid-feedback" role="alert" style="display: block">
                                                    <strong v-for="error in errors.logo">
                                                        <span>{{error}}</span>
                                                    </strong>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-12 col-form-label text-md-left">Users</label>

                                        <span v-if='errors.users' class="invalid-feedback" role="alert" style="display: block">
                                            <strong v-for="error in errors.users">
                                                <span>{{error}}</span>
                                            </strong>
                                        </span>

                                        <div class="col-md-12">
                                            <div class="form-check" v-for="user in allUsers">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input"
                                                    :id="user.id"
                                                    :value="user.id"
                                                    v-model="users"
                                                >
                                                <label :for="user.id" class="form-check-label">{{ user.name }} ({{ user.email }})</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
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
            this.getDepartment();
            this.formData = new FormData();
            this.config = { 'content-type': 'multipart/form-data' };
        },
        methods:{
            getDepartment(){
                axios.get('/api/department/'+this.id).then((res) => {
                    this.name = res.data.department.name;
                    this.description = res.data.department.description;
                    this.logo = res.data.department.logo;
                    this.allUsers = res.data.users;
                    this.users = res.data.selectedUsers;
                });
            },
            updateDepartment(){
                this.errors = [];

                const formData = new FormData();
                const config = { 'content-type': 'multipart/form-data' };

                formData.append('name', this.name);
                formData.append('description', this.description);

                if(this.changeLogo){
                    formData.append('logo', this.logo);
                }

                formData.append('users', this.users);
                formData.append("_method", "put");

                axios.post('/api/department/'+this.id, formData, config)
                    .then((res) => {
                        if(res.status === 200){
                            this.$router.replace({name: 'department'});
                        }
                    })
                    .catch((error) => {
                        if(error.response.data.errors){
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            handleFileUpload(){
                this.logo = this.$refs.file.files[0];
                this.changeLogo = true;
            }
        },
        data(){
            return{
                name: '',
                description: '',
                logo: '',
                users: [],
                allUsers: [],
                errors: [],
                id: '',
                changeLogo: false
            }
        },
        components: {
            AppNav:Nav,
        }
    }
</script>
