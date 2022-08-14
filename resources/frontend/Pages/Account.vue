<template layout="AppShell,Authenticated">
  <div>
    <Head :title="title" />

    <h1 class="text-h4">
      {{ title }}
    </h1>
  </div>
</template>

<script setup>
defineProps({
  title: String
})
</script>
