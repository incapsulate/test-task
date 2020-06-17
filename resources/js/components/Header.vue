<template>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div v-if="isAuthorized()" class="navbar-nav">
                <RouterLink :to="{name: 'home'}" class="nav-item nav-link">Home</RouterLink>
                <RouterLink to="dashboard" class="nav-item nav-link">Dashboard</RouterLink>
                <a href="#" class="nav-item nav-link" @click.prevent="logout">Logout</a>
            </div>
            <div v-else class="navbar-nav">
                <RouterLink :to="{name: 'home'}" class="nav-item nav-link">Home</RouterLink>
                <RouterLink to="register" class="nav-item nav-link">Register</RouterLink>
                <RouterLink to="login" class="nav-item nav-link">Login</RouterLink>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "app-header",
        methods: {
            isAuthorized() {
                return this.$auth.check();
            },
            logout() {
                this.$auth.logout();
            }
        }
    }
</script>
