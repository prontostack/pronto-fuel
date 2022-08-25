<template>
  <section class="tw-flex tw-space-x-6 tw-text-right">
    <header class="tw-flex tw-flex-col tw-space-y-2 tw-w-1/3">
      <h2
        v-if="title"
        class="tw-text-2xl"
        v-text="title"
      />
      <span
        v-if="hint"
        class="tw-text-sm tw-font-thin tw-opacity-60"
        v-text="hint"
      />
    </header>
    <div class="tw-w-2/3">
      <slot />
    </div>
  </section>
</template>

<script setup>
defineProps({
  title: String,
  hint: String
})
</script>
