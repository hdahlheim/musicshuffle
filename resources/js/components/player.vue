<template>
  <div>
    <div class="flex justify-around w-full" id="app">
      <div class="flex self-center">
        <div class="flex flex-col items-center">
          <h1 class="text-4xl font-bold">Current Song: {{currentSong.name}}</h1>
          <youtube
            @ready="ready"
            @ended="nextSong"
            :player-width="450"
            :host="host"
            :video-id="videoId"
            :player-vars="playerVars" />
          <button class="w-full text-lg btn-teal" @click="nextSong">Next</button>
        </div>
      </div>
      <div class="relative w-1/2 max-h-full overflow-y-scroll rounded-sm shadow-inner">
        <h2 class="text-4xl">Queue:</h2>
        <ul>
          <li
            v-for="song in unplayedSongs" :key="song.id"
            class="flex items-center justify-between p-4 m-3 bg-gray-700 rounded-sm"
            >
            <div>
              <svg @click="playThisSong(song)" viewBox="0 0 24 24" class="w-10 h-10">
                  <circle cx="12" cy="12" r="10" class="text-gray-200 fill-current"></circle>
                  <path class="text-gray-700 fill-current" d="M15.51 11.14a1 1 0 0 1 0 1.72l-5 3A1 1 0 0 1 9 15V9a1 1 0 0 1 1.51-.86l5 3z"></path>
              </svg>
            </div>
            <div class="text-lg font-semibold leading-none">
                {{ song.name }}
            </div>
            <div>
              Votes: {{ song.upvote }}
            </div>
          </li>
        </ul>
      </div>
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
    unplayedSongs(){
      return this.songs.filter((item) => {
          return !this.playedSongs.includes(item)
      })
    }
  },
  methods: {
    ready(event) {
      this.player = event.target
      this.nextSong()
    },
    nextSong() {
      if (this.currentSong !== '') {
        this.playedSongs.push(this.currentSong)
      }
      const nextSong = this.unplayedSongs.shift()
      this.currentSong = nextSong
      this.videoId = nextSong.youtube_id
    },
    playThisSong(song) {
      this.playedSongs.push(this.currentSong)
      this.playedSongs.push(song)
      this.currentSong = song
      this.videoId = song.youtube_id
    }
  }
}
</script>
