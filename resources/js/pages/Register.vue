<template>
    <div class="container">
        <app-header></app-header>
        <div class="card card-default">
            <div class="card-header">Registration</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>{{ error }}</p>
                </div>
                <form @submit.prevent="register" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" placeholder="Dmitry" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import AppHeader from '../components/Header.vue';

    export default {
        data() {
            return {
                name: '',
                email: '',
                password: '',
                has_error: false,
                error: '',
            }
        },
        components: {
            AppHeader
        },
        methods: {
            register() {
                this.$auth.register({
                    data: {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                    },
                    success: () => {
                        this.$router.push({name: 'login'})
                    },
                    error: (res) => {
                        this.has_error = true;
                        this.error = res.response.data.error;
                    },
                })
            }
        }
    }
</script>
