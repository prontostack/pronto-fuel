<template>
  <div>
    <div
      v-if="!loaded"
      class="q-pa-md tw-flex tw-justify-center"
    >
      <q-card
        flat
        bordered
        style="width: 100%; max-width: 550px"
      >
        <q-item>
          <q-item-section avatar>
            <q-skeleton type="QAvatar" />
          </q-item-section>

          <q-item-section>
            <q-item-label>
              <q-skeleton type="text" />
            </q-item-label>
            <q-item-label caption>
              <q-skeleton
                type="text"
                width="80%"
              />
            </q-item-label>
          </q-item-section>
        </q-item>

        <q-item>
          <q-item-section avatar />

          <q-item-section class="q-pl-sm">
            <q-skeleton
              height="150px"
              class="q-mb-sm"
            />

            <div class="row items-center justify-between no-wrap">
              <div class="row items-center">
                <i-mdi-comment-outline class="tw-text-black/20 tw-mr-2" />
                <q-skeleton
                  type="text"
                  width="30px"
                />
              </div>

              <div class="row items-center">
                <i-mdi-repeat class="tw-text-black/20 tw-mr-2" />
                <q-skeleton
                  type="text"
                  width="30px"
                />
              </div>

              <div class="row items-center">
                <i-mdi-heart-outline class="tw-text-black/20 tw-mr-2" />
                <q-skeleton
                  type="text"
                  width="30px"
                />
              </div>
            </div>
          </q-item-section>
        </q-item>
      </q-card>
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
