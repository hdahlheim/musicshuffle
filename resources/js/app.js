import Vue from 'vue'
import App from './components/player.vue'
import VueYoutube from 'vue-youtube-embed'

Vue.use(VueYoutube)

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
})
