<template>
  <div>
    <YouTube
      v-if="ready"
      :youtube-url="data.source"
      :width="data.width"
      :height="data.height"
      :player-settings="data.playerSettings"
    />
  </div>
</template>

<script setup>
import axios from 'axios'
import to from 'await-to-js'
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'

const { data } = storeToRefs(useEmbed())

const ready = ref(false)

const fetchInfo = async () => {
  const [err, res] = await to(axios.get(`https://www.youtube.com/oembed?url=${window.encodeURI(data.value.source)}&maxwidth=640&maxheight=640`))

  if (err) {
    console.log(err)
  }

  const { width, height } = res.data

  data.value.width = width
  data.value.height = height
}

if (!data.value.rendering) {
  fetchInfo().then(() => {
    ready.value = true
  })
} else {
  ready.value = true
}
</script>
