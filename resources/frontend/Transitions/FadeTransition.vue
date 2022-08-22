<template>
  <Transition
    name="fade"
    mode="out-in"
  >
    <slot />
  </Transition>
</template>

<script setup>
defineProps({
  id: String
})
</script>

<style lang="scss">
.fade-enter-active,
.fade-leave-active {
  transition: opacity .4s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
