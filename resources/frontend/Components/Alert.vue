<template>
  <div
    class="
      tw-flex
      tw-p-4
      tw-rounded-lg
      tw-shadow-md
    "
    :class="containerClasses"
    role="alert"
  >
    <span
      class="
        tw-inline-flex
        tw-h-8
        tw-w-8
      "
    >
      <i-mdi-information
        class="
          tw-text-white/60
          tw-text-lg
        "
      />
    </span>
    <div
      class="
        tw-ml-3
        tw-font-medium
        tw-text-white
      "
    >
      <slot />
    </div>
    <button
      aria-label="Close"
      type="button"
      class="
        tw-inline-flex
        tw-h-8
        tw-w-8
        tw-p-1.5
        tw-ml-auto
        -tw-mx-1.5
        -tw-my-1.5
        tw-rounded-lg
        tw-transition-all
        focus:tw-ring-2
        tw-text-white/60
        hover:tw-bg-white/20
        hover:tw-text-white
        focus:tw-ring-white/50
        focus:tw-text-white
      "
      @click="$emit('dismiss')"
    >
      <i-mdi-close />
    </button>
  </div>
</template>

<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'info'
  }
})

defineEmits(['dismiss'])

const containerColors = {
  error: [
    'tw-bg-danger-500',
    'tw-shadow-danger-500/30'
  ],
  warning: [
    'tw-bg-warning-500',
    'tw-shadow-warning-500/30'
  ],
  info: [
    'tw-bg-info-500',
    'tw-shadow-info-500/30'
  ],
  success: [
    'tw-bg-success-500',
    'tw-shadow-success-500/30'
  ]
}

const containerClasses = computed(() => {
  return containerColors[props.type]
})
</script>
