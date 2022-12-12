<template>
  <Modal max-width="600">
    <v-card color="primary">
      <v-card-title>
        {{ title }}
      </v-card-title>
      <v-card-text>
        <span>{{ message }}</span>
      </v-card-text>
    </v-card>
  </Modal>
</template>

<script setup>
defineProps({
  title: String,
  message: String,
  position: String
})
</script>
