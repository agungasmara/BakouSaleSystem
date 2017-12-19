import Vue from 'vue'
import VueRouter from 'vue-router'

// FrontEnd #######################
import FHome from './views/Components/frontend/home.vue'
// Backend ###################
import Home from './views/Components/index.vue'
import Register from './views/Auth/Register.vue'
import Login from './views/Auth/Login.vue'
import List from './views/Auth/List.vue'
import ShowForm from './views/Auth/Show.vue'
import CreateForm from './views/Auth/Form.vue'
import Appf from './Appf.vue'
import App from './App.vue'
import Appl from './Appl.vue'
//import router from './router'
import VueResource from 'vue-resource'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
Vue.use(VueResource);
Vue.use(VueRouter)
const router = new VueRouter({
  mode: 'history',
  routes: [
    // routing FrontEnd
    { path: '/', name:'fhome',component: FHome },
    // routing Backend
    { path: '/auth/login', name:'login',component: Login },
    { path: '/admin', name:'ahome',component: Home },
    { path: '/admin/list', name:'floo',component: List },
    { path: '/register', name:'foo',component: Register }
  ]
})

// const routerf = new VueRouter({
//   mode: 'history',
//   routes: [
//     // routing FrontEnd
//     { path: '/', name:'fhome',component: FHome },
//     // routing Backend
//     { path: '/auth/login', name:'login',component: Login },
//     { path: '/admin', name:'ahome',component: Home },
//     { path: '/admin/list', name:'floo',component: List },
//     { path: '/register', name:'foo',component: Register }
//   ]
// })

// app frontend
const appf = new Vue({
    // el: '#root',
    router,
    template: `
    <appf></appf>
  `,
    components: { Appf },
}).$mount('#root_frontend')


// app backend

const app = new Vue({
    // el: '#root',
    router,
    template: `
    <app></app>
  `,
    components: { App },
}).$mount('#root')


const AuthLogin = new Vue({
    // el: '#root',
    router,
    template: `
    <appl></appl>
  `,
    components: { Appl },
}).$mount('#root_login')



// import Vue from 'vue'
// import VueRouter from 'vue-router'
// import routes from './router/router'

// import Home from './views/Components/index.vue'
// import Register from './views/Auth/Register.vue'
// import Login from './views/Auth/Login.vue'
// import List from './views/Auth/List.vue'
// import ShowForm from './views/Auth/Show.vue'
// import CreateForm from './views/Auth/Form.vue'

// // import store from './store/'
// import {routerMode} from './config/env'
// import './config/rem'
// import FastClick from 'fastclick'

// if ('addEventListener' in document) {
//     document.addEventListener('DOMContentLoaded', function() {
//         FastClick.attach(document.body);
//     }, false);
// }

// Vue.use(VueRouter)
// const router = new VueRouter({
//   routes,
//   mode: routerMode,
//   strict: process.env.NODE_ENV !== 'production',
//   scrollBehavior (to, from, savedPosition) {
//       if (savedPosition) {
//         return savedPosition
//     } else {
//       if (from.meta.keepAlive) {
//         from.meta.savedPosition = document.body.scrollTop;
//       }
//         return { x: 0, y: to.meta.savedPosition || 0 }
//     }
//   }
// })


// const app = new Vue({
//   router,
// }).$mount('#root')