<template layout="AppShell,Subscriber">
  <v-container class="tw-my-4 md:tw-my-8">
    <v-row>
      <v-col>
        <h1 class="text-h4">
          {{ title }}
        </h1>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
defineProps({
  title: String
})
</script>
