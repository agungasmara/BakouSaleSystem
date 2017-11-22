import Vue from 'vue'
import VueRouter from 'vue-router'
import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'


Vue.use(VueRouter)

// const User = {
//   template: '<div>User</div>'
// }

const router = new VueRouter({
  routes: [
    // dynamic segments start with a colon
    { path: '/register', component: Register },
    { path: '/login', component: Login }
  ]
})

// const router = new VueRouter({
//     routers: [

//         {path: 'register', component: Register }
        
//     ]
// })

export default router
