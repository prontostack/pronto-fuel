<template>
  <q-card>
    <q-card-section>
      <header
        v-if="title"
        class="tw-text-xl tw-mb-3"
        v-text="title"
      />
      <div
        v-if="hint"
        class="tw-mb-4 tw-text-sm tw-opacity-60"
        v-text="hint"
      />
      <slot />
    </q-card-section>
  </q-card>
</template>

<script setup>
defineProps({
  title: String,
  hint: String
})
</script>
