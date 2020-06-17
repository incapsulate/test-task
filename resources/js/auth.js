import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'

const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenStore: ['localStorage'],
    registerData: {url: 'user/register', method: 'POST', redirect: '/dashboard'},
    loginData: {url: 'user/login', method: 'POST', redirect: '/dashboard', fetchUser: true},
    logoutData: {url: 'user/logout', method: 'POST', redirect: '/', makeRequest: true},
    fetchData: {url: 'user', method: 'GET', enabled: true},
    refreshData: {url: 'user', method: 'GET', enabled: true, interval: 30}
}
export default config
