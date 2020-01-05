<template>
    <div class="flex justify-between w-full" id="app">
      <div class="self-center w-1/3 p-4 mr-4 bg-gray-700 rounded">
        <div>
          <div>
            <span class="text-lg text-gray-500">Current Song:</span>
            <h1 class="text-4xl font-bold">{{currentSong.name}}</h1>
          </div>
          <div class="w-full overflow-hidden rounded">
            <youtube
              @ready="ready"
              @ended="nextSong"
              :player-width="360"
              :host="host"
              :video-id="videoId"
              :player-vars="playerVars" />
          </div>
          <button class="w-full my-4 text-lg btn-teal" @click="nextSong">Next</button>
        </div>
      </div>
      <div class="relative w-2/3 max-h-full overflow-y-scroll rounded-sm">
        <h2 class="mb-4 text-lg font-semibold text-gray-500">Queue:</h2>
        <ul>
          <li
            v-for="song in unplayedSongs" :key="song.id"
            class="flex items-center justify-between px-6 py-2 mb-2 bg-gray-700 rounded-sm"
            >
            <div class="flex-shrink-0 min-w-0">
              <svg @click="playThisSong(song)" viewBox="0 0 24 24" class="w-8 h-8">
                  <circle cx="12" cy="12" r="10" class="text-gray-500 fill-current hover:text-teal-500"></circle>
                  <path class="text-gray-700 fill-current" d="M15.51 11.14a1 1 0 0 1 0 1.72l-5 3A1 1 0 0 1 9 15V9a1 1 0 0 1 1.51-.86l5 3z"></path>
              </svg>
            </div>
            <div class="w-3/4 font-semibold leading-none">
                {{ song.name }}
            </div>
            <div>
              <span class="font-semibold">Votes:</span> {{ song.upvote }}
            </div>
          </li>
        </ul>
      </div>
    </div>
</template>

<script>
export default {
  props: {
    playlist:{
      type: Object
    }
  },
  /**
   * Dataattributes for the vue component
   */
  data() {
    return {
      playedSongs: [],
      songs: [],
      currentSong: '',
      player: null,
      videoId: null,
      host: 'https://www.youtube-nocookie.com',
      playerVars: {
        autoplay: 1
      }
    }
  },
  beforeMount() {
    this.songs = this.playlist.songs
  },
  computed: {
    /**
     * Returns a list of unplayed songs
     */
    unplayedSongs(){
      return this.songs.filter((item) => {
          return !this.playedSongs.includes(item)
      })
    }
  },
  methods: {
    /**
     * This method gets called when the iframe player is ready and starts
     * the next song in the playlist
     */
    ready(event) {
      this.player = event.target
      this.nextSong()
    },
    /**
     * Moves the current song to the played list and sets the next song
     * in the list as current song.
     */
    nextSong() {
      if (this.currentSong !== '') {
        this.playedSongs.push(this.currentSong)
      }
      const nextSong = this.unplayedSongs.shift()
      this.currentSong = nextSong
      this.videoId = nextSong.youtube_id
    },
    /**
     * Sets the selected song as current song and moves previous the current
     * to the played list.
     */
    playThisSong(song) {
      this.playedSongs.push(this.currentSong)
      this.playedSongs.push(song)
      this.currentSong = song
      this.videoId = song.youtube_id
    }
  }
}
</script>
