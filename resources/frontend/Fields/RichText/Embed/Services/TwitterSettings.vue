<template>
  <div class="tw-pt-1 tw-px-2 tw-w-56 tw-box-border">
    <Switch
      v-model="data.showConversation"
      label="Show conversation"
      hide-details
    />
    <Switch
      v-model="data.hideCards"
      label="Hide cards"
      hide-details
    />
    <Switch
      v-model="data.dark"
      label="Use dark theme"
      hide-details
    />
    <Switch
      v-model="data.dnt"
      label="Prevent tracking"
      hide-details
    />
    <div class="tw-my-3">
      <span class="tw-block text-caption">Alignment:</span>
      <TextAlignmentToggle v-model="data.align" />
    </div>
    <div>
      <span class="tw-block text-caption">Max width:</span>
      <Slider
        v-model="data.maxWidth"
        :min="250"
        :max="550"
        :step="1"
        thumb-label
        color="primary"
        hide-details
      />
    </div>
  </div>
</template>

<script setup>
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'

const { data } = storeToRefs(useEmbed())
</script>

<style lang="scss" scoped>

</style>
