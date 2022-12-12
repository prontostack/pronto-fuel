<template>
  <SlideOver :location="location">
    <v-card
      color="primary"
      class="tw-h-screen"
    >
      <v-card-title>
        {{ title }}
      </v-card-title>
      <v-card-text>
        <span>{{ message }}</span>
      </v-card-text>
    </v-card>
  </SlideOver>
</template>

<script setup>
defineProps({
  title: String,
  message: String,
  location: String
})
</script>
