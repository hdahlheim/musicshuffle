<template>
  <div>
    <div class="flex justify-between w-full h-64" id="app">
      <youtube :player-width="320" :host="host" :video-id="videoId" :player-vars="playerVars" @playing="playing" />
      <div class="w-2/3 max-h-full overflow-scroll">
        <ul>
          <li class="block p-4 m-3 bg-gray-700 rounded-sm" v-for="(key) in 20" :key="key">
            Playlisttime
          </li>
        </ul>
      </div>
    </div>
    <div>
      <button>Whatever</button>
      <button>Play</button>
      <button>Next</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      videoId: 'BW1aX0IbZOE',
      host: 'https://www.youtube-nocookie.com',
      playerVars: {
        autoplay: 1
      }
    }
  }
}
</script>
