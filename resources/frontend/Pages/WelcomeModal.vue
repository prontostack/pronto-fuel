<template>
  <Modal>
    <q-card class=" tw-text-white">
      <q-toolbar class="tw-bg-primary-600">
        <q-toolbar-title>
          {{ title }}
        </q-toolbar-title>
      </q-toolbar>
      <q-card-section class="tw-bg-primary-500">
        <span class="tw-text-lg">{{ message }}</span>
      </q-card-section>
    </q-card>
  </Modal>
</template>

<script setup>
defineProps({
  title: String,
  message: String,
  position: String
})
</script>
