<template>
  <q-input
    outlined
    :error="error && (typeof error !== undefined)"
    :error-message="error"
  />
</template>

<script setup>
defineProps({
  error: String
})
</script>
