import Vue from 'vue'
import VueRouter from 'vue-router'
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
  routes: [
    // dynamic segments start with a colon
    { path: '/register', component: Register },
    { path: '/login', component: Login },
    { path: '/list', component: List },
    { path: '/show/:id', component: ShowForm },
    { path: '/list/:id/edit', component: CreateForm, meta:{mode:'edit'}}
  ]
})

// const router = new VueRouter({
//     routers: [

//         {path: 'register', component: Register }
        
//     ]
// })

export default router
