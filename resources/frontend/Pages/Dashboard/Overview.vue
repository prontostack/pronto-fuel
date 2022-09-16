<template layout="AppShell,Authenticated">
  <div class="tw-p-6">
    <Head :title="title" />

    <h1 class="text-h4 tw-mb-6">
      {{ title }}
    </h1>
  </div>
</template>

<script setup>
defineProps({
  title: String
})
</script>
