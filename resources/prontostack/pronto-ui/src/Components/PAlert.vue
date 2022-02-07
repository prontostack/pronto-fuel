<template>
  <div
    class="
      flex
      p-4
      rounded-lg
      shadow-md
    "
    :class="containerClasses"
    role="alert"
  >
    <span
      class="
        inline-flex
        h-8
        w-8
      "
    >
      <i-mdi-information
        class="
        text-white/60
          text-lg
        "
      />
    </span>
    <div
      class="
        ml-3
        font-medium
        text-white
      "
    >
      <slot />
    </div>
    <button
      aria-label="Close"
      type="button"
      class="
        inline-flex
        h-8
        w-8
        p-1.5
        ml-auto
        -mx-1.5
        -my-1.5
        rounded-lg
        transition-all
        focus:ring-2
        text-white/60
        hover:bg-white/20
        hover:text-white
        focus:ring-white/50
        focus:text-white
      "
      @click="$emit('dismiss')"
    >
      <span class="sr-only">Close</span>
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
    'bg-danger-500',
    'shadow-danger-500/30'
  ],
  warning: [
    'bg-warning-500',
    'shadow-warning-500/30'
  ],
  info: [
    'bg-info-500',
    'shadow-info-500/30'
  ],
  success: [
    'bg-success-500',
    'shadow-success-500/30'
  ]
}

const containerClasses = computed(() => {
  return containerColors[props.type]
})
</script>
