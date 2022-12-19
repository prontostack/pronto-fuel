<template>
  <v-icon :icon="icon" />
</template>

<script setup>
import loadIcon from '@/helpers/load-icon'

const props = defineProps({
  name: String
})

const icon = ref(null)

loadIcon.then((loadedIcon) => {
  icon.value = loadedIcon
})
</script>

<style lang="scss" scoped>

</style>
