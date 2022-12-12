<template>
  <v-sheet class="tw-p-6">
    <header
      v-if="title"
      class="tw-mb-4"
    >
      {{ title }}
    </header>
    <div>
      <div
        v-if="hint"
        class="tw-mb-6 tw-text-sm tw-opacity-60"
        v-text="hint"
      />
      <slot />
    </div>
  </v-sheet>
</template>

<script setup>
defineProps({
  title: String,
  hint: String
})
</script>
