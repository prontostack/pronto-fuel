<template>
  <v-overlay
    :transition="
      location === 'left'
        ? 'slide-x-transition'
        : 'slide-x-reverse-transition'
    "
    :content-class="{
      'tw-right-0': location === 'right'
    }"
    :model-value="show"
    @update:model-value="(val) => {
      if (val) return
      redirect()
    }"
  >
    <slot />
  </v-overlay>
</template>
<script setup>
import { useModal } from 'momentum-modal'

const { show, redirect } = useModal()

const props = defineProps({
  location: String
})
</script>
