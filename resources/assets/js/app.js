require('./bootstrap');
require('./additional')
window.Vue = require('vue');
Vue.config.productionTip = false
Vue.component('leftbar', require('./components/leftbar.vue'));
Vue.component('company-title', require('./components/company-title.vue'));
const app = new Vue({
    el: '#app'
});
