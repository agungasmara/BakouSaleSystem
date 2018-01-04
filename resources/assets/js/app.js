import Vue from 'vue'
import VueRouter from 'vue-router'

// FrontEnd #######################
import Appf from './Appf.vue'
import FHome from './views/Components/frontend/home.vue'
import FAccount from './views/Components/frontend/account/signin.vue'
// Backend ###################
    import Home from './views/Components/index.vue'
    import Register from './views/Auth/Register.vue'
    import Login from './views/Auth/Login.vue'
    import List from './views/Auth/List.vue'
    import ShowForm from './views/Auth/Show.vue'
    import CreateForm from './views/Auth/Form.vue'
    import App from './App.vue'
    import Appl from './Appl.vue'
    //setting########################
    import SettingForm from './views/Components/backend/settings/MainForm.vue'
    import SettingList from './views/Components/backend/settings/SettingList.vue'
    import SettingEditForm from './views/Components/backend/settings/EditForm.vue'
    //end setting####################

    //User and user Group########################
    import UserGroupForm from './views/Components/backend/users/MainForm.vue'
    import UserList from './views/Components/backend/users/UserList.vue'
    import UserEditForm from './views/Components/backend/users/UserEditForm.vue'
    import UserGroupList from './views/Components/backend/users/UserGroupList.vue'
    import UserGroupEditForm from './views/Components/backend/users/EditForm.vue'
    //End User Group####################

//import router from './router'
import VueResource from 'vue-resource'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
Vue.use(VueResource);
Vue.use(VueRouter)

Vue.http.options.credentials = true;

Vue.http.options.xhr = {
  withCredentials: true
}
Vue.http.options.emulateJSON = true
Vue.http.options.emulateHTTP = true
Vue.http.options.crossOrigin = true

Vue.http.headers.common['Access-Control-Allow-Origin'] = 'http://localhost:9200'
Vue.http.headers.common['Access-Control-Request-Method'] = '*'
Vue.http.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'
Vue.http.headers.common['Accept'] = 'application/json, text/plain, */*'
Vue.http.headers.common['Access-Control-Allow-Headers'] = 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin'

const router = new VueRouter({
  mode: 'history',
  routes: [
    // routing FrontEnd
    { path: '/', name:'fhome',component: FHome },
    { path: '/my_account', name:'fmyaccount', component: FAccount },
    { path: '/signin', name:'fsignin', component: FAccount },
    // routing Backend
    { path: '/auth/login', name:'login',component: Login },
    { path: '/admin', name:'ahome',component: Home },
    { path: '/admin/list', name:'floo',component: List },
    { path: '/register', name:'foo',component: Register },
    //Setting
    { path: '/admin/settings/add',component:SettingForm},
    { path: '/admin/settings/list',component:SettingList},
    { path: '/admin/settings/edit/:id',component:SettingEditForm,props:true},
    //User and User Group 
    { path: '/admin/user/add',component:UserGroupForm},
    { path: '/admin/user/list',component:UserList},
     { path: '/admin/user/edit/:id',component:UserEditForm,props:true},
    { path: '/admin/user_group/list',component:UserGroupList},
    { path: '/admin/user_group/edit/:id',component:UserGroupEditForm,props:true}
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