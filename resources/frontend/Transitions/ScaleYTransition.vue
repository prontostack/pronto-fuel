<template>
  <Transition name="scale-y">
    <slot />
  </Transition>
</template>

<script setup>
defineProps({
  id: String
})
</script>

<style lang="scss">
.scale-y-enter-active,
.scale-y-leave-active {
  transition: all .4s ease;
  transition-property: transform, opacity;
  transform-origin: 100% 50%;
}

.scale-y-enter-from,
.scale-y-leave-to {
  transform: scaleY(.5);
  opacity: 0;
}
</style>
