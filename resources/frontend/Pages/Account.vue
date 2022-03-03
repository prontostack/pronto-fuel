<template layout="Authenticated">
  <Head :title="title" />

  <h1 class="text-h4">
    {{ title }}
  </h1>
</template>

<script setup>
defineProps({
  title: String
})
</script>
