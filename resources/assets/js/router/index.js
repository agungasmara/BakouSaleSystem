import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Components/index.vue'
import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import List from '../views/Auth/List.vue'
import ShowForm from '../views/Auth/Show.vue'
import CreateForm from '../views/Auth/Form.vue'

Vue.use(VueRouter)

// const User = {
//   template: '<div>User</div>'
// }
const router = new VueRouter({
	mode: 'history',
  routes: [
    { path: '/admin', component: Home },
    { path: '/admin/list', component: List },
    { path: '/register', component: Register }
  ]
})

// const router = new VueRouter({
//     routers: [

//         {path: 'register', component: Register }
        
//     ]
// })

export default router
