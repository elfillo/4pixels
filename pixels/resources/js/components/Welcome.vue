<template>
    <div>
        <app-nav></app-nav>
        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body text-center">Hello {{ authUser }} !</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Nav from "./Nav";
    export default {
        data(){
            return {
                authUser: document.querySelector('meta[name="user-name"]').getAttribute('content'),
            }
        },
        components: {
            AppNav:Nav,
        }
    }
</script>
