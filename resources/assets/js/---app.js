import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from './views/Components/index.vue'
import Register from './views/Auth/Register.vue'
import Login from './views/Auth/Login.vue'
import List from './views/Auth/List.vue'
import ShowForm from './views/Auth/Show.vue'
import CreateForm from './views/Auth/Form.vue'
import App from './app.vue'
//import router from './router'
import VueResource from 'vue-resource'
import Vuetify from 'vuetify'

Vue.use(Vuetify)
Vue.use(VueResource);
Vue.use(VueRouter)
const router = new VueRouter({
	mode: 'history',
  routes: [
    { path: '/admin', name:'home',component: Home },
    { path: '/admin/list', name:'foo',component: List },
    { path: '/register', name:'foo',component: Register }
  ]
})


const app = new Vue({
    // el: '#root',
    router,
    template: `
    <app></app>
  `,
    components: { App },
}).$mount('#root')


// export default app

// import Vue from 'vue'
// import VueRouter from 'vue-router'
// import App from './App.vue'
// import Home from './views/Components/index.vue'

// Vue.use(VueRouter)

// // const Home = { template: '<div>This is Home</div>' }
// const Foo = { template: '<div>This is Foo</div>' }
// const Bar = { template: '<div>This is Bar {{ $route.params.id }}</div>' }

// const router = new VueRouter({
//   mode: 'history',
//   base: __dirname,
//   routes: [
//     { path: '/admin', name: 'home', component: Home },
//     { path: '/admin/list', name: 'foo', component: Foo },
//     { path: '/bar/:id', name: 'bar', component: Bar }
//   ]
// })

// new Vue({
//   router,
//   template: `
//     <div id="root">
//       <h1>Named Routes</h1>
//       <p>Current route name: {{ $route.name }}</p>
//       <ul>
//         <li><router-link :to="{ name: 'home' }">home</router-link></li>
//         <li><router-link :to="{ name: 'foo' }">foo</router-link></li>
//         <li><router-link :to="{ name: 'bar', params: { id: 123 }}">bar</router-link></li>
//       </ul>
//       <router-view class="view"></router-view>
//     </div>
//   `
// }).$mount('#root')

// new Vue({
//   router,
//   template: `
//     <div id="root">
//       <h1>Named Routes</h1>
//       <p>Current route name: {{ $route.name }}</p>
//       <ul>
//         <li><router-link :to="{ name: 'home' }">home</router-link></li>
//         <li><router-link :to="{ name: 'foo' }">foo</router-link></li>
//         <li><router-link :to="{ name: 'bar', params: { id: 123 }}">bar</router-link></li>
//       </ul>
//       <router-view class="view"></router-view>
//     </div>
//   `
// }).$mount('#root')

// const NotFound = { template: '<p>Page dnot found</p>' }
// const Home = { template: Home }
// const About = { template: '<p>about page</p>' }

// const routes = {
//   '/admin': Home,
//   '/list': About
// }

// new Vue({
//   el: '#root',
//   data: {
//     currentRoute: window.location.pathname
//   },
//   computed: {
//     ViewComponent () {
//       return routes[this.currentRoute] || NotFound
//     }
//   },
//   render (h) { return h(this.ViewComponent) }
// })