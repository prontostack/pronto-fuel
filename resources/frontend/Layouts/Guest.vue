<template>
  <v-app :theme="darkMode.enabled ? 'dark' : 'light'">
    <div
      class="
      tw-flex
      tw-flex-col
      tw-min-h-screen
      tw-justify-center
      tw-items-center
      tw-p-6
    "
    >
      <div class="tw-w-full tw-max-w-md">
        <FadeTransition>
          <slot />
        </FadeTransition>
      </div>
    </div>
  </v-app>
</template>

<script setup>
import { useDarkMode } from '@/store/dark-mode'

const darkMode = useDarkMode()
</script>
