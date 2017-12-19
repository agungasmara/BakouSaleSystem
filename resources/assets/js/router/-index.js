import Vue from 'vue'
import VueRouter from 'vue-router'
import App from '../app.vue'
import Home from '../views/Components/index.vue'
import Register from '../views/Auth/Register.vue'
import Login from '../views/Auth/Login.vue'
import List from '../views/Auth/List.vue'
import ShowForm from '../views/Auth/Show.vue'
import CreateForm from '../views/Auth/Form.vue'

Vue.use(VueRouter)

// export default [{
//     path: '/admin',
//     component: App, //顶层路由，对应index.html
//     children: [ //二级路由。对应App.vue
//         //地址为空时跳转home页面
//         {
//             path: '',
//             redirect: '/admin/list'
//         },
//       ]
//     }];

// const User = {
//   template: '<div>User</div>'
// }

// const router = new VueRouter({
// 	mode: 'history',
//   base: __dirname,
//   routes: [
//     // the following object is a route record
//     { path: '/admin', component: Home,
//       children: [
//         // this is also a route record
//         { path: 'list', component: List },
//         { path: 'register', component: Register }
//       ]
//     }
//   ]
// })

const router = new VueRouter({
    routers: [

        {path: 'register', component: Register }
        
    ]
})

export default router
