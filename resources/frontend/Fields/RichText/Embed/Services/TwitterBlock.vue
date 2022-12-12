<template>
  <div>
    <div
      v-if="!loaded"
      class="tw-flex tw-justify-center"
    >
      <RichTextLoader />
    </div>
    <div>
      <div v-if="!refreshing && !invalid">
        <div ref="tweet" />
      </div>
      <div v-else-if="invalid">
        <TextField
          v-model="data.source"
          error="A URL inserida parece ser inválida. Verifique."
          @focus="$event.target.select()"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'
import { twitter } from '@/helpers/third-party-script'

const { data, service } = storeToRefs(useEmbed())

const tweet = ref(null)
const loaded = ref(false)
const refreshing = ref(false)
const invalid = ref(false)

const tweetId = computed(() => service.value.regex.exec(data.value.source)[2])

const renderTweet = () => {
  if (!window.twttr?.widgets) {
    return
  }

  window.twttr.widgets.createTweet(
    tweetId.value,
    tweet.value,
    {
      align: data.value.align,
      cards: data.value.hideCards ? 'hidden' : '',
      conversation: data.value.showConversation ? '' : 'none',
      dnt: data.dnt ? 'true' : '',
      theme: data.value.dark ? 'dark' : '',
      width: data.value.maxWidth
    }
  ).then((el) => {
    if (!el) {
      invalid.value = true
    }

    loaded.value = true
  })
}

// Load Twitter's JavaScript oEmbed API
twitter()

onMounted(() => {
  window.twttr.ready(() => {
    renderTweet()
  })
})

watch(data, () => {
  invalid.value = false
  refreshing.value = true // Removes the rendered Tweet from the DOM
  loaded.value = false

  nextTick(() => {
    refreshing.value = false // Re-inserts the Tweet container into the DOM

    nextTick(() => {
      renderTweet()
    })
  })
}, {
  deep: true
})
</script>
