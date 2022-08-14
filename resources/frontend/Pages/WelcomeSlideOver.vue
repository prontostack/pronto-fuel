<template>
  <SlideOver :position="position">
    <div class="tw-max-w-sm tw-h-full tw-bg-primary-500 tw-text-white">
      <q-toolbar class="tw-bg-primary-600">
        <q-toolbar-title>
          <span class="tw-block tw-px-6 tw-py-4">{{ title }}</span>
        </q-toolbar-title>
      </q-toolbar>
      <div class="tw-p-8">
        <span class="tw-text-lg">{{ message }}</span>
      </div>
    </div>
  </SlideOver>
</template>

<script setup>
defineProps({
  title: String,
  message: String,
  position: String
})
</script>
