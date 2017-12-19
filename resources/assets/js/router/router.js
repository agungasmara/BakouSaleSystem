import App from '../App.vue'
import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Components/index.vue'
import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import List from '../views/Auth/List.vue'
import ShowForm from '../views/Auth/Show.vue'
import CreateForm from '../views/Auth/Form.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [

        { path: '/admin', name:'home',component: Home },
        { path: '/admin/list', name:'foo',component: List },
        { path: '/register', name:'foso',component: Register }
        
    ]
})

export default router


// export default [
//     { path: '/admin', name:'home',component: Home },
//     { path: '/admin/list', name:'foo',component: List },
//     { path: '/register', name:'foso',component: Register }
// ]