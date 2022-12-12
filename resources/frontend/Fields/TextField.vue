<template>
  <v-text-field
    :error-messages="error"
  />
</template>

<script setup>
defineProps({
  error: String
})
</script>
