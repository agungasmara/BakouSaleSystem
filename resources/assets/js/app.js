import Vue from 'vue'

import App from './app.vue'
import router from './router'
import VueResource from 'vue-resource';
import Vuetify from 'vuetify'

Vue.use(Vuetify)
Vue.use(VueResource);

const app = new Vue({
    el: '#root',
    template: `<app></app>`,
    components: { App },
    router
})