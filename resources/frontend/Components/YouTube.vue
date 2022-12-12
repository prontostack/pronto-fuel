<template>
  <div class="tw-flex tw-justify-center tw-items-center tw-relative tw-w-full">
    <div
      v-if="!refreshing"
      class="youtube-embed tw-relative tw-w-full"
      :class="{
        'tw-max-w-[360px]': orientation === 'portrait'
      }"
    >
      <div
        :class="{
          'tw-pb-[56.25%]': orientation === 'landscape',
          'tw-pb-[177.77%]': orientation === 'portrait'
        }"
      >
        <div ref="container" />
      </div>
    </div>
    <div
      v-if="!loaded"
      class="tw-flex tw-justify-center tw-items-center tw-absolute tw-inset-0"
    >
      <RichTextLoader />
    </div>
  </div>
  <!--
    <iframe
      :src="`https://www.youtube.com/embed/${videoId}?feature=oembed`"
      :width="width"
      :height="height"
      frameborder="0"
      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
      allowfullscreen
    />
  -->
</template>

<script setup>
import YouTubePlayer from 'youtube-player'
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'
import { nextTick } from 'vue'

const props = defineProps({
  youtubeId: String,
  youtubeUrl: String,
  width: {
    type: Number,
    default: 640
  },
  height: {
    type: Number,
    default: 360
  },
  playerSettings: {
    type: Object,
    default: () => ({})
  }
})

const { service } = storeToRefs(useEmbed())

const container = ref(null)
const player = ref(null)
const loaded = ref(false)
const refreshing = ref(false)

const videoId = computed(() => {
  if (props.youtubeId) {
    return props.youtubeId
  }

  if (typeof props.youtubeUrl === 'string') {
    return props.youtubeUrl.match(service.value.regex)[1]
  }

  return null
})

const orientation = computed(() => (props.height > props.width) ? 'portrait' : 'landscape')

const renderVideo = () => {
  // const defaultPlayerVars = {
  //   // ...service.value.defaults.playerSettings
  // }

  player.value = YouTubePlayer(container.value, {
    videoId: videoId.value,
    width: props.width,
    height: props.height,
    playerVars: {
      // defaultPlayerVars,
      ...props.playerSettings
    }
  })

  player.value.on('ready', () => {
    loaded.value = true
  })
}

onMounted(() => {
  renderVideo()
})

watch(props.playerSettings, () => {
  console.log('WATHING: ', videoId.value)
  refreshing.value = true
  loaded.value = false

  nextTick(() => {
    refreshing.value = false

    nextTick(() => {
      renderVideo()
    })
  })
}, {
  deep: true
})
</script>

<style lang="scss">
.youtube-embed {
  iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
  }
}
</style>
