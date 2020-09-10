require('./bootstrap');

import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

var data = {state: 1,alert: null, code: null, schedules: null, appointment: null}; 

new Vue({
  render: h => h(App),
  data,
}).$mount('#app')
