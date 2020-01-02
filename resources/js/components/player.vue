<template>
  <div>
    <div style="max-height: 90vh;" class="flex justify-around w-full mt-16" id="app">
      <div class="flex self-center">
        <div>
          <youtube

            @ready="ready"
            @ended="ended"
            :player-width="420"
            :host="host"
            :video-id="videoId"
            :player-vars="playerVars" />
          <button class="relative">
            <svg viewBox="0 0 24 24" class="w-20 h-20">
                <circle cx="12" cy="12" r="10" class="bg-gray-200 fill-current"></circle>
                <path class="secondary" d="M15.51 11.14a1 1 0 0 1 0 1.72l-5 3A1 1 0 0 1 9 15V9a1 1 0 0 1 1.51-.86l5 3z"></path>
            </svg>
          </button>
          <button>
              <svg viewBox="0 0 24 24" class="w-16 h-16">
                  <circle cx="12" cy="12" r="10" class="text-gray-200 fill-current"></circle>
                  <path class="secondary" d="M14.59 13H7a1 1 0 0 1 0-2h7.59l-2.3-2.3a1 1 0 1 1 1.42-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.42-1.4l2.3-2.3z"></path>
              </svg>
          </button>
        </div>
      </div>
      <div class="relative w-1/2 max-h-full m-4 overflow-y-scroll bg-gray-900 rounded-sm shadow-inner">
        <ul>
          <li
            v-for="(key) in 20" :key="key"
            class="flex items-center p-4 m-3 bg-gray-700 rounded-sm"
            >
            <div>
              <svg viewBox="0 0 24 24" class="w-10 h-10">
                  <circle cx="12" cy="12" r="10" class="text-gray-200 fill-current"></circle>
                  <path class="text-gray-700 fill-current" d="M15.51 11.14a1 1 0 0 1 0 1.72l-5 3A1 1 0 0 1 9 15V9a1 1 0 0 1 1.51-.86l5 3z"></path>
              </svg>
            </div>
            <div class="text-lg font-semibold leading-none">
              Playlisttime
            </div>
            <div>Votes</div>
            <div></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      playedSongs: [],
      songs: [
        'BW1aX0IbZOE',
        '0rb9CfOvojk',
      ],
      player: null,
      videoId: null,
      host: 'https://www.youtube-nocookie.com',
      playerVars: {
        autoplay: 1
      }
    }
  },
  methods: {
    ready(event) {
      this.player = event.target
      this.nextSong()
    },
    ended() {
      this.playedSongs.push(this.videoId)
      this.nextSong()
    },
    nextSong() {
      const unplayedSongs = this.songs.filter((item) => {
        return !this.playedSongs.includes(item)
      })
      const nextSong = unplayedSongs.shift()
      this.videoId = nextSong
    }
  }
}
</script>
