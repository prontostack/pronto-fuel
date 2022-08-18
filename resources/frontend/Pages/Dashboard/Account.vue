<template layout="AppShell,Authenticated">
  <div class="tw-p-6">
    <Head :title="title" />

    <h1 class="text-h4">
      {{ title }}
    </h1>

    <Form v-bind="form" />
  </div>
</template>

<script setup>
defineProps({
  title: String,
  form: Object
})
</script>
