<template>
    <div class="container">
        <app-header></app-header>
        <div class="card card-default">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                <h1>User Profile</h1>
                <div v-if="user" class="user-profile">
                    <div class="form-elements">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <span class="form-control">{{ user.name }}</span>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">E-mail</span>
                            </div>
                            <span class="form-control">{{ user.email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import AppHeader from '../components/Header.vue';

    export default {
        data() {
            return {
                user: null
            }
        },
        mounted() {
            this.user =  this.$auth.user();
        },
        components: {
            AppHeader
        },
    }
</script>
