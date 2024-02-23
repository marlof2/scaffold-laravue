import Vue from 'vue'
import App from './App.vue'
import Api from "./api/index";

import STRINGS from "./utils/strings";
import COLORS from "./utils/colors";
import MASKS from "./utils/masks";

Vue.prototype.$strings = STRINGS;
Vue.prototype.$colors = COLORS;
Vue.prototype.$masks = MASKS;

// VUEX - https://vuex.vuejs.org/
import store from './store'

// VUE-ROUTER - https://router.vuejs.org/
import router from './router'

// PLUGINS
import vuetify from './plugins/vuetify'
import i18n from './plugins/vue-i18n'
import './plugins/vue-google-maps'
import './plugins/vue-shortkey'
import './plugins/vue-head'
import './plugins/vue-gtag'
import './plugins/apexcharts'
import './plugins/echarts'
import './plugins/animate'
import './plugins/clipboard'
import './plugins/moment'

// FILTERS
import './filters/index'

// STYLES
// Main Theme SCSS
import './assets/scss/theme.scss'

// Animation library - https://animate.style/
import 'animate.css/animate.min.css'

// Set this to false to prevent the production tip on Vue startup.
Vue.config.productionTip = false

import VueMask from "v-mask";
Vue.use(VueMask);

import Swal from "./mixins/swal";
window.Swal = Swal;


import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
Vue.use(VueSweetalert2);


//Segurança Cryptografia
import cryptografia from "./seguranca";

Api.init();



// Vue.directive("permissions", {
//   inserted(el, binding, vnode) {
//     if (!binding.value || binding.value == "") {
//       return true;
//     }
//     if (!JSON.parse(localStorage.getItem("permissoes").includes(binding.value))) {
//       vnode.elm.parentElement.remove();
//     }
//   },
// });


//usado com o componente <DataAtableGeneric></DataAtableGeneric> novo
Vue.directive("permissions", {
  inserted(el, binding, vnode) {
    if (!binding.value || binding.value == "") {
      return true;
    }
    if (
      !JSON.parse(
        localStorage.getItem("permissoes").includes(binding.value)
      )
    ) {
      vnode.elm.remove();
    }
  },
});



/*
|---------------------------------------------------------------------
| Main Vue Instance
|---------------------------------------------------------------------
|
| Render the vue application on the <div id="app"></div> in index.html
|
| https://vuejs.org/v2/guide/instance.html
|
*/
export default new Vue({
  i18n,
  vuetify,
  router,
  store,
  render: (h) => h(App)
}).$mount('#app')
