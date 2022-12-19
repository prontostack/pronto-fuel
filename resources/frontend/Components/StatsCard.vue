<template>
  <v-card
    :color="color"
    :theme="theme"
  >
    <v-card-title class="tw-bg-black/5">
      <span class="tw-text-sm">{{ title }}</span>
    </v-card-title>

    <v-card-text>
      <span class="tw-block tw-pt-3 tw-text-lg tw-font-black">{{ text }}</span>
    </v-card-text>
  </v-card>
</template>

<script setup>
const props = defineProps({
  color: {
    type: String,
    default: 'primary'
  },
  theme: {
    type: String,
    default: 'dark'
  },
  title: String,
  text: [String, Number]
})
</script>

<style lang="scss" scoped>

</style>
