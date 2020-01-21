<template>
    <div>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link :to="{ name: 'welcome' }" class="navbar-brand">Laravel</router-link>
            <router-link :to="{ name: 'user' }" class="navbar-brand">Users</router-link>
            <router-link :to="{ name: 'department' }" class="navbar-brand">Departments</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">

                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown d-flex align-items-center">
                        {{ authUser }}
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <div class="dropdown-item" style="cursor: pointer" v-on:click="Logout">Logout</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </div>
</template>
<script>
    export default {
        mounted() {

        },
        methods: {
            Logout(){
                axios.defaults.headers.common['X-CSRF-TOKEN'] = this.csrf;
                axios.post('logout').catch(() => {
                    window.location = '/';
                });
            }
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                authUser: document.querySelector('meta[name="user-name"]').getAttribute('content'),
            }
        }
    }
</script>
