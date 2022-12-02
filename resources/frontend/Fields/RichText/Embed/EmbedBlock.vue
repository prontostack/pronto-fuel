<template>
  <div
    v-observe-visibility="{
      callback: visibilityChanged,
      once: true,
    }"
    class="ce-embed cdx-block"
  >
    <div v-if="isVisible">
      <div
        v-if="embed"
        class="ce-embed__preview"
        :data-service="blockData.service"
      >
        <div v-html="embed" />
      </div>
      <component
        :is="blockComponent"
        v-else-if="blockComponent"
      />
    </div>
  </div>
</template>

<script>
import asyncComponents from '@/helpers/async-components'
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'

export default {
  components: asyncComponents(import.meta.glob('./Services/*Block.vue'))
}
</script>

<script setup>
const { blockComponent, data, service } = storeToRefs(useEmbed())

const embed = computed(() => {
  if (!service.value || service.value?.component) {
    return null
  }

  const { id = (ids) => ids.shift() } = service.value

  const match = service.value.regex.exec(data.source).slice(1)

  const embedUrl = service.value.embedUrl.replace(/<%= remote_id %>/g, id(match))

  return service.value.html.replace(/<%= src %>/g, embedUrl)
})

const isVisible = ref(false)

const visibilityChanged = (visibility) => {
  isVisible.value = visibility
}
</script>

<style lang="scss">
</style>
