<template>
  <q-btn
    unelevated
    :outline="outlined"
  >
    <slot />
  </q-btn>
</template>

<script setup>
defineProps({
  outlined: Boolean
})
</script>
