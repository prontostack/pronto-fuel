<template>
  <input
    type="hidden"
    :value="modelValue"
  >
</template>

<script setup>
defineProps({
  modelValue: undefined
})
</script>
