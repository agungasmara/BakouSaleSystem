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
import OrderInfo from './views/Components/frontend/account/order_info.vue'
import AddressList from './views/Components/frontend/account/address_list.vue'
import AddressAdd from './views/Components/frontend/account/address_add.vue'
import AddressForm from './views/Components/frontend/account/address_form.vue'
import AddressMy from './views/Components/frontend/account/address_my.vue'
import InformationUser from './views/Components/frontend/account/information_user.vue'
import WishList from './views/Components/frontend/account/wishlist.vue'

//***** products *****
import Product from './views/Components/frontend/product/product.vue'
import ProductDetail from './views/Components/frontend/product/product_detail.vue'
import Information from './views/Components/frontend/information/information.vue'
import InformationDetail from './views/Components/frontend/information/information_detail.vue'
// **** Cart ******
import Cart from './views/Components/frontend/checkout/cart.vue'
import CartView from './views/Components/frontend/checkout/cart_view.vue'
import Checkout from './views/Components/frontend/checkout/checkout.vue'
import CheckoutSuccess from './views/Components/frontend/checkout/checkout_success.vue'


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

//***** Language *****
import Language from './views/Components/backend/languages/Language.vue'
import LanguageList from './views/Components/backend/languages/LanguageList.vue'
import LanguageForm from './views/Components/backend/languages/MainForm.vue'
import LanguageEdit from './views/Components/backend/languages/EditForm.vue'

//***** Currency *****
import Currency from './views/Components/backend/currency/Currency.vue'
import CurrencyList from './views/Components/backend/currency/CurrencyList.vue'
import CurrencyForm from './views/Components/backend/currency/MainForm.vue'
import CurrencyEdit from './views/Components/backend/currency/EditForm.vue'

//***** Stock Status *****
import StockStatus from './views/Components/backend/stocks/StockStatus.vue'
import StockStatusList from './views/Components/backend/stocks/StockStatusList.vue'
import StockStatusForm from './views/Components/backend/stocks/MainForm.vue'
import StockStatusEdit from './views/Components/backend/stocks/EditForm.vue'

//***** Order Status *****
import OrderStatusB from './views/Components/backend/order_status/OrderStatus.vue'
import OrderStatusList from './views/Components/backend/order_status/OrderStatusList.vue'
import OrderStatusForm from './views/Components/backend/order_status/MainForm.vue'
import OrderStatusEdit from './views/Components/backend/order_status/EditForm.vue'

//***** Credit Type *****
import CreditType from './views/Components/backend/credit_option/CreditType.vue'
import CreditTypeList from './views/Components/backend/credit_option/CreditTypeList.vue'
import CreditTypeForm from './views/Components/backend/credit_option/MainForm.vue'
import CreditTypeEdit from './views/Components/backend/credit_option/EditForm.vue'

//***** Credit Type Value *****
import CreditTypeValue from './views/Components/backend/credit_option/CreditTypeValue.vue'
import CreditTypeValueList from './views/Components/backend/credit_option/CreditTypeValueList.vue'
import CreditTypeValueForm from './views/Components/backend/credit_option/CreditTypeValueForm.vue'
import CreditTypeValueEdit from './views/Components/backend/credit_option/CreditTypeValueEditForm.vue'

//***** Tax Class *****
import TaxClass from './views/Components/backend/tax/tax_class/TaxClass.vue'
import TaxClassList from './views/Components/backend/tax/tax_class/TaxClassList.vue'
import TaxClassForm from './views/Components/backend/tax/tax_class/MainForm.vue'
import TaxClassEdit from './views/Components/backend/tax/tax_class/EditForm.vue'

//***** Tax Rate *****
import TaxRate from './views/Components/backend/tax/tax_rate/TaxRate.vue'
import TaxRateList from './views/Components/backend/tax/tax_rate/TaxRateList.vue'
import TaxRateForm from './views/Components/backend/tax/tax_rate/MainForm.vue'
import TaxRateEdit from './views/Components/backend/tax/tax_rate/EditForm.vue'

//***** Tax Rule *****
import TaxRule from './views/Components/backend/tax/tax_rule/TaxRule.vue'
import TaxRuleList from './views/Components/backend/tax/tax_rule/TaxRuleList.vue'
import TaxRuleForm from './views/Components/backend/tax/tax_rule/MainForm.vue'
import TaxRuleEdit from './views/Components/backend/tax/tax_rule/EditForm.vue'

//***** Tax Rate To Customer Group *****
import TaxRateCustomerGroup from './views/Components/backend/tax/tax_rate_to_customer_group/TaxRateToCustomerGroup.vue'
import TaxRateCustomerGroupList from './views/Components/backend/tax/tax_rate_to_customer_group/TaxRateToCustomerGroupList.vue'
import TaxRateCustomerGroupForm from './views/Components/backend/tax/tax_rate_to_customer_group/MainForm.vue'
import TaxRateCustomerGroupEdit from './views/Components/backend/tax/tax_rate_to_customer_group/EditForm.vue'

//***** Weight*****
import Weight from './views/Components/backend/weight/Weight.vue'
import WeightList from './views/Components/backend/weight/WeightList.vue'
import WeightForm from './views/Components/backend/weight/MainForm.vue'
import WeightEdit from './views/Components/backend/weight/EditForm.vue'

//***** Length*****
import Length from './views/Components/backend/length/Length.vue'
import LengthList from './views/Components/backend/length/LengthList.vue'
import LengthForm from './views/Components/backend/length/MainForm.vue'
import LengthEdit from './views/Components/backend/length/EditForm.vue'

//***** Manufacturer*****
import Manufacturer from './views/Components/backend/manufacurere/Manufacturer.vue'
import ManufacturerList from './views/Components/backend/manufacurere/ManufacturerList.vue'
import ManufacturerForm from './views/Components/backend/manufacurere/MainForm.vue'
import ManufacturerEdit from './views/Components/backend/manufacurere/EditForm.vue'

//***** Download*****
import Download from './views/Components/backend/download/Download.vue'
import DownloadList from './views/Components/backend/download/DownloadList.vue'
import DownloadForm from './views/Components/backend/download/MainForm.vue'
import DownloadEdit from './views/Components/backend/download/EditForm.vue'

//***** Previews*****
import Preview from './views/Components/backend/preview/Preview.vue'
import PreviewList from './views/Components/backend/preview/PreviewList.vue'
import PreviewForm from './views/Components/backend/preview/MainForm.vue'
import PreviewEdit from './views/Components/backend/preview/EditForm.vue'

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
            path: 'order_info/:id',
            name: 'orderinfo',
            component: OrderInfo,props:true
          },
          {
            path: 'addresslist',
            name: 'addresslist',
            component: AddressList
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
          },
          {
            path: 'addressmy',
            name: 'addressmy',
            component: AddressMy
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
      path: '/cart', name:'cart',component: Cart,
      children:[
        {
          path: 'cartview',
          name:'cartview',
          component: CartView
        },
        {
          path: 'checkout',
          name:'checkout',
          component: Checkout
        },
        {
          path: 'checkoutsuccess',
          name:'checkoutsuccess',
          component: CheckoutSuccess
        }
      ]
    },
    // {
    //   path: '/information/information_detail/:id', name:'information',component: Information,
    //   components: { default: Information, footer: Footer },
    //   props: { default: true, footer: false }
    // },
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

    //Setting
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
                name:'UserEdit',
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
    {path:'/admin/languages',name:'languages',component:Language,
        children:[
            {
                path:'list',
                name:'LanguageList',
                component:LanguageList
            },
            {
                path:'add',
                name:'LanguageForm',
                component:LanguageForm
            },
            {
                path:'edit/:id',
                name:'LanguageEdit',
                component:LanguageEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/currencies',name:'currencies',component:Currency,
        children:[
            {
                path:'list',
                name:'CurrencyList',
                component:CurrencyList
            },
            {
                path:'add',
                name:'CurrencyForm',
                component:CurrencyForm
            },
            {
                path:'edit/:id',
                name:'CurrencyEdit',
                component:CurrencyEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/stock_status',name:'stock_status',component:StockStatus,
        children:[
            {
                path:'list',
                name:'StockStatusList',
                component:StockStatusList
            },
            {
                path:'add',
                name:'StockStatusForm',
                component:StockStatusForm
            },
            {
                path:'edit/:id',
                name:'StockStatusEdit',
                component:StockStatusEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/order_status',name:'order_status',component:OrderStatusB,
        children:[
            {
                path:'list',
                name:'OrderStatusList',
                component:OrderStatusList
            },
            {
                path:'add',
                name:'OrderStatusForm',
                component:OrderStatusForm
            },
            {
                path:'edit/:id',
                name:'OrderStatusEdit',
                component:OrderStatusEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/credit_type',name:'credit_type',component:CreditType,
        children:[
            {
                path:'list',
                name:'CreditTypeList',
                component:CreditTypeList
            },
            {
                path:'add',
                name:'CreditTypeForm',
                component:CreditTypeForm
            },
            {
                path:'edit/:id',
                name:'CreditTypeEdit',
                component:CreditTypeEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/credit_type_value',name:'credit_type_value',component:CreditTypeValue,
        children:[
            {
                path:'list',
                name:'CreditTypeValueList',
                component:CreditTypeValueList
            },
            {
                path:'add',
                name:'CreditTypeValueForm',
                component:CreditTypeValueForm
            },
            {
                path:'edit/:id',
                name:'CreditTypeValueEdit',
                component:CreditTypeValueEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/tax_class',name:'tax_class',component:TaxClass,
        children:[
            {
                path:'list',
                name:'TaxClassList',
                component:TaxClassList
            },
            {
                path:'add',
                name:'TaxClassForm',
                component:TaxClassForm
            },
            {
                path:'edit/:id',
                name:'TaxClassEdit',
                component:TaxClassEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/tax_rule',name:'tax_rule',component:TaxRule,
        children:[
            {
                path:'list',
                name:'TaxRuleList',
                component:TaxRuleList
            },
            {
                path:'add',
                name:'TaxRuleForm',
                component:TaxRuleForm
            },
            {
                path:'edit/:id',
                name:'TaxRuleEdit',
                component:TaxRuleEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/tax_rate',name:'tax_rate',component:TaxRate,
        children:[
            {
                path:'list',
                name:'TaxRuleList',
                component:TaxRateList
            },
            {
                path:'add',
                name:'TaxRuleForm',
                component:TaxRateForm
            },
            {
                path:'edit/:id',
                name:'TaxRulesEdit',
                component:TaxRateEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/tax_rate_customer_group',name:'tax_rate_customer_group',component:TaxRateCustomerGroup,
        children:[
            {
                path:'list',
                name:'TaxRageCustomerGroupList',
                component:TaxRateCustomerGroupList
            },
            {
                path:'add',
                name:'TaxRageCustomerGroupForm',
                component:TaxRateCustomerGroupForm
            },
            {
                path:'edit/:id',
                name:'TaxRageCustomerGroupEdit',
                component:TaxRateCustomerGroupEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/weights',name:'weight',component:Weight,
        children:[
            {
                path:'list',
                name:'WeightList',
                component:WeightList
            },
            {
                path:'add',
                name:'MainForm',
                component:WeightForm
            },
            {
                path:'edit/:id',
                name:'EditForm',
                component:WeightEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/lengths',name:'lengths',component:Length,
        children:[
            {
                path:'list',
                name:'LengthList',
                component:LengthList
            },
            {
                path:'add',
                name:'MainForm',
                component:LengthForm
            },
            {
                path:'edit/:id',
                name:'EditForm',
                component:LengthEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/manufacturers',name:'manufatutreres',component:Manufacturer,
        children:[
            {
                path:'list',
                name:'ManufacturerList',
                component:ManufacturerList
            },
            {
                path:'add',
                name:'MainForm',
                component:ManufacturerForm
            },
            {
                path:'edit/:id',
                name:'EditForm',
                component:ManufacturerEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/downloads',name:'downloads',component:Download,
        children:[
            {
                path:'list',
                name:'DownloadList',
                component:DownloadList
            },
            {
                path:'add',
                name:'MainForm',
                component:DownloadForm
            },
            {
                path:'edit/:id',
                name:'EditForm',
                component:DownloadEdit,
                props:true
            }
        ]       
    },
    {path:'/admin/previews',name:'previews',component:Preview,
        children:[
            {
                path:'list',
                name:'PreviewsList',
                component:PreviewsList
            },
            {
                path:'add',
                name:'MainForm',
                component:PreviewsForm
            },
            {
                path:'edit/:id',
                name:'EditForm',
                component:PreviewsEdit,
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