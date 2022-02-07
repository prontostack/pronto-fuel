<template>
  <div v-if="$slots.default">
    <p class="mt-1 text-sm text-red-500 dark:text-red-500">
      <slot />
    </p>
  </div>
</template>
