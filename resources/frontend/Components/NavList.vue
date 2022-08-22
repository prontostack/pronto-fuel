<template>
  <ul class="tw-relative tw-z-0 tw-py-2">
    <slot />
  </ul>
</template>

<script setup>
const props = defineProps({
  bookmarker: Boolean
})

provide('bookmarker', props.bookmarker)
</script>
