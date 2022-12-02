<template>
  <h1>Ads: {{ title }}</h1>
</template>

<script setup>
const props = defineProps({
  test: String
})

const title = computed(() => 'Title: ' + props.test)

const getData = () => {
  return {
    title
  }
}

defineExpose({
  getData
})
</script>t
