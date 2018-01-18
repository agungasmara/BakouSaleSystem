import Vue from 'vue'
import VueRouter from 'vue-router'

// FrontEnd #######################
import Appf from './Appf.vue'
import FHome from './views/Components/frontend/home.vue'
//***** Account *****
import Account from './views/Components/frontend/account/account.vue'
import FSignIn from './views/Components/frontend/account/signin.vue'
import FRegister from './views/Components/frontend/account/register.vue'
import FLogin from './views/Components/frontend/account/login.vue'
import Dashboard from './views/Components/frontend/account/dashboard.vue'
import OrderList from './views/Components/frontend/account/order_list.vue'
import AddressList from './views/Components/frontend/account/address_list.vue'
import AddressForm from './views/Components/frontend/account/address_form.vue'
import OrderStatus from './views/Components/frontend/account/order_status.vue'
import AddressAdd from './views/Components/frontend/account/address_add.vue'
import InformationUser from './views/Components/frontend/account/information_user.vue'
import WishList from './views/Components/frontend/account/wishlist.vue'

//***** products *****
import Product from './views/Components/frontend/product/product.vue'
import ProductDetail from './views/Components/frontend/product/product_detail.vue'
import Information from './views/Components/frontend/information/information.vue'
import InformationDetail from './views/Components/frontend/information/information_detail.vue'
// **** Footer *****
import Footer from './views/Components/frontend/common/_footer.vue'

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
import Setting from './views/Components/backend/settings/Setting.vue'
import SettingForm from './views/Components/backend/settings/MainForm.vue'
import SettingList from './views/Components/backend/settings/SettingList.vue'
import SettingEditForm from './views/Components/backend/settings/EditForm.vue'
//end setting####################

//User and user Group########################

import User from './views/Components/backend/users/User.vue'
import UserForm from './views/Components/backend/users/MainForm.vue'
import UserList from './views/Components/backend/users/UserList.vue'
import UserEditForm from './views/Components/backend/users/UserEditForm.vue'

//User group#########################
// import UserGroupForm from './views/Components/backend/groups/MainForm.vue'
// import UserGroupList from './views/Components/backend/groups/UserGroupList.vue'
// import UserGroupEditForm from './views/Components/backend/groups/UserGroupEditForm.vue'
import UserGroup from './views/Components/backend/user_groups/UserGroup.vue'
import UserGroupForm from './views/Components/backend/user_groups/MainForm.vue'
import UserGroupList from './views/Components/backend/user_groups/UserGroupList.vue'
import UserGroupEditForm from './views/Components/backend/user_groups/UserGroupEditForm.vue'
//User Role#########################
import UserRole from './views/Components/backend/users/UserRole.vue'
import UserRoleList from './views/Components/backend/users/UserRoleList.vue'
import UserRoleForm from './views/Components/backend/users/UserRoleForm.vue'
import UserRoleEdit from './views/Components/backend/users/UserRoleEdit.vue'
import UserRolePermission from './views/Components/backend/users/UserRolePermission.vue'

//End User Group####################

//***** Categories *****
import Category from './views/Components/backend/categories/Category.vue'
import CategoryList from './views/Components/backend/categories/CategoryList.vue'
import CategoryForm from './views/Components/backend/categories/CategoryForm.vue'
import CategoryEdit from './views/Components/backend/categories/CategoryEdit.vue'
//***** End Categories *****

//***** products *****
import Products from './views/Components/backend/products/Product.vue'
import ProductList from './views/Components/backend/products/ProductList.vue'
import ProductForm from './views/Components/backend/products/ProductForm.vue'
import ProductEdit from './views/Components/backend/products/ProductEdit.vue'
//***** End products *****

//***** Attribute *****
import Attribute from './views/Components/backend/attributes/Attribute.vue'
import AttributeList from './views/Components/backend/attributes/AttributeList.vue'
import AttributeForm from './views/Components/backend/attributes/AttributeForm.vue'
import AttributeEdit from './views/Components/backend/attributes/AttributeEdit.vue'

//Language########################
import Languages from './views/Components/backend/languages/Language.vue'
import LanguagesForm from './views/Components/backend/languages/MainForm.vue'
import LanguagesList from './views/Components/backend/languages/LanguagesList.vue'
import LanguagesEditForm from './views/Components/backend/languages/EditForm.vue'
//end Language####################

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
    {path: '/product', name:'product',component:Product,
        children: [
            {
              path: 'product_detail/:id',
              name: ProductDetail,
              component: ProductDetail,props:true
            }
        ]
    },
    { path: '/account', name:'account', component: Account,
      children: [
          {
            path: 'signin',
            name:'signin',
            component: FSignIn
          },
          {
            path: 'register',
            name:'register',
            component: FRegister
          },
          {
            path: 'login',
            name:'login',
            component: FLogin
          },
          {
            path: 'dashboard',
            name: 'dashboard',
            component: Dashboard
          },
          {
            path: 'orderlist',
            name: 'orderlist',
            component: OrderList
          },
          {
            path: 'addresslist',
            name: 'addresslist',
            component: AddressList
          },
          {
            path: 'orderstatus',
            name: 'orderstatus',
            component: OrderStatus
          },
          {
            path: 'addressadd',
            name: 'addressadd',
            component: AddressAdd
          },
          {
            path: 'informationuser',
            name: 'informationuser',
            component: InformationUser
          },
          {
            path: 'wishlist',
            name: 'wishlist',
            component: WishList
          }
      ]
    },
    { 
      path: '/information', name:'information',component: Information,
      children:[
        {
          path: 'information_detail/:id',
          name:'InformationDetail',
          component: InformationDetail,props:true
          // props: (route) => ({ id: route.query.id }) 
          // components: { default: InformationDetail, footer: Footer },
          // props: { default: true, footer: false }
          // component: InformationDetail
        }
      ]
    },
    {
      path: '/information/information_detail/:id', name:'information_detail',component: Information,
      components: { default: Information, footer: Footer },
      props: { default: true, footer: false }
    },
    // routing Backend
    { path: '/auth/login', name:'login',component: Login },
    { path: '/admin', name:'ahome',component: Home },
    { path: '/admin/list', name:'floo',component: List },
    { path: '/register', name:'foo',component: Register },
    // ***** attributes *****
    { path: '/admin/attributes', name:'attributes',component: Attribute,
      children: [
        {
          path: 'list',
          name:'AttributeList',
          component: AttributeList
        },
        {
          path: 'add',
          name:'AttributeForm',
          component: AttributeForm
        },
        {
          path: 'edit/:id',
          name:'AttributeEdit',
          component: AttributeEdit,props:true
        }
      ]
    },
    { path: '/admin/categories', name:'categories',component: Category,
      children: [
        {
          path: 'list',
          name:'CategoryList',
          component: CategoryList
        },
        {
          path: 'add',
          name:'CategoryForm',
          component: CategoryForm
        },
        {
          path: 'edit/:id',
          name:'CategoryEdit',
          component: CategoryEdit,props:true
        }
      ]
    },
    { path: '/admin/products', name:'products',component: Products,
      children: [
        {
          path: 'list',
          name:'ProductList',
          component: ProductList
        },
        {
          path: 'add',
          name:'ProductForm',
          component: ProductForm
        },
        {
          path: 'edit/:id',
          name:'ProductEdit',
          component: ProductEdit,props:true
        }
      ]
    },
    {path:'/admin/settings',name:'settings',component:Setting,
        children:[
            {
                path:'list',
                name:'SettingList',
                component:SettingList
            },
            {
                path:'add',
                name:'SettingForm',
                component:SettingForm
            },
            {
                path:'edit/:id',
                name:'SettingEditForm',
                component:SettingEditForm,
                props:true
            }
        ]       
    },
    //User and User Group 
    {path:'/admin/users',name:'users',component:User,
        children:[
            {
                path:'list',
                name:'UserList',
                component:UserList
            },
            {
                path:'add',
                name:'UserForm',
                component:UserForm
            },
            {
                path:'edit/:id',
                name:'UserEditForm',
                component:UserEditForm,
                props:true
            }
        ]       
    },
    {path:'/admin/users_group',name:'usergroup',component:UserGroup,
        children:[
            {
                path:'list',
                name:'UserGroupList',
                component:UserGroupList
            },
            {
                path:'add',
                name:'UserGroupForm',
                component:UserGroupForm
            },
            {
                path:'edit/:id',
                name:'UserGroupEdit',
                component:UserGroupEditForm,
                props:true
            }
        ]       
    },
    {path:'/admin/user_role',name:'user_role',component:UserRole,
        children:[
            {
                path:'list',
                name:'UserRoleList',
                component:UserRoleList
            },
            {
                path:'add',
                name:'UserRoleForm',
                component:UserRoleForm
            },
            {
                path:'edit/:id',
                name:'UserRoleEdit',
                component:UserRoleEdit,
                props:true
            },
            {
                path:'permission/:id',
                name:'UserRolePermission',
                component:UserRolePermission,
                props:true
            }
        ]       
    },
    {path:'/admin/languages',name:'languages',component:Languages,
        children:[
            {
                path:'list',
                name:'LanguagesList',
                component:LanguagesList
            },
            {
                path:'add',
                name:'LanguagesForm',
                component:LanguagesForm
            },
            {
                path:'edit/:id',
                name:'LanguagesEdit',
                component:LanguagesEditForm,
                props:true
            }
        ]       
    }
  ],
  scrollBehavior (to, from, savedPosition) {
    return { x: 10, y: 0 }
  },
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

// if( document.getElementById("#root") ) {
  // app backend
  const app = new Vue({
      // el: '#root',
      router,
      template: `
      <app></app>
    `,
      components: { App },
  }).$mount('#root')
// }

// app frontend
// if(document.getElementById("#root_frontend") ) {
  const appf = new Vue({
      // el: '#root',
      router,
      template: `
      <appf></appf>`,
      components: { Appf },
  }).$mount('#root_frontend')
// }

// if( document.getElementById("#root_login") ) {
  const AuthLogin = new Vue({
      // el: '#root',
      router,
      template: `
      <appl></appl>
    `,
      components: { Appl },
  }).$mount('#root_login')
// }