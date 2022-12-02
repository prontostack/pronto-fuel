<template>
  <div class="tw-pt-1 tw-px-1 tw-w-48 tw-box-border">
    <Switch
      v-model="data.showConversation"
      label="Show conversation"
    />
    <Switch
      v-model="data.hideCards"
      label="Hide cards"
    />
    <Switch
      v-model="data.dark"
      label="Use dark theme"
    />
    <Switch
      v-model="data.dnt"
      label="Prevent tracking"
    />
    <div class="tw-px-3 tw-my-3">
      <span class="tw-block text-caption">Alignment:</span>
      <TextAlignmentToggle v-model="data.align" />
    </div>
    <div class="tw-px-3">
      <span class="tw-block text-caption">Max width:</span>
      <Slider
        v-model="data.maxWidth"
        :min="250"
        :max="550"
        :step="1"
        label
        color="primary"
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
