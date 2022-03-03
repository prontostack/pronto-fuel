<template layout="Authenticated">
  <Head :title="title" />

  <h1 class="text-h4 tw-mb-6">
    {{ title }}
  </h1>

  <p class="text-body-1">
    Try out a server driven toast notification handled with Inertia:
  </p>

  <p class="text-body-1">
    Checkout the <span class="tw-bg-gray-200 tw-rounded tw-p-1">routes/web.php</span> file to see how does it work.
  </p>

  <q-btn
    color="positive"
    @click="$inertia.post('/notify')"
  >
    Success toast
  </q-btn>
</template>

<script setup>
defineProps({
  title: String
})
</script>
