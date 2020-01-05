import Vue from 'vue'
import player from './components/player.vue'
import VueYoutube from 'vue-youtube-embed'

/**
 * Register the vue youtube player component
 */
Vue.use(VueYoutube)

/**
 * Create a vue instance for the DOM node with the id #player
 */
new Vue({
  el: '#player',
  components: { player },
  data: {
    playlist: null
  },
  beforeMount () {
    const rawPlaylist = this.$el.attributes['data-playlist'].value
    this.playlist = JSON.parse(rawPlaylist)
  },
  template: '<player :playlist="playlist" />',
})
