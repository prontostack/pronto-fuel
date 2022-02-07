<template>
  <div v-if="$slots.default">
    <p class="mt-1 text-sm text-danger-500 dark:text-danger-500">
      <slot />
    </p>
  </div>
</template>
