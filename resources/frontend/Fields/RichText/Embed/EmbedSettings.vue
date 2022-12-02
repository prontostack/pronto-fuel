<template>
  <component
    :is="settingsComponent"
    v-if="settingsComponent"
  />
</template>

<script>
import asyncComponents from '@/helpers/async-components'
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'

export default {
  components: asyncComponents(import.meta.glob('./Services/*Settings.vue'))
}
</script>

<script setup>
const { settingsComponent } = storeToRefs(useEmbed())
</script>
