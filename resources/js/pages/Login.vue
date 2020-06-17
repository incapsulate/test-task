<template>
    <div class="container">
        <app-header></app-header>
        <div class="card card-default">
            <div class="card-header">Login</div>
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>{{ error }}</p>
                </div>
                <form @submit.prevent="login" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
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
                email: null,
                password: null,
                has_error: false,
                error: ''
            }
        },
        components: {
            AppHeader
        },
        methods: {
            login() {
                this.$auth.login({
                    params: {
                        email: this.email,
                        password: this.password
                    },
                    success: () => {
                        this.$router.push({name: 'dashboard'})
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
