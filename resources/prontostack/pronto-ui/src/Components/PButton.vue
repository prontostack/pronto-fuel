<template>
  <button
    :disabled="disabled"
    class="
      bg-gradient-to-b
      text-white
      text-center
      font-semibold
      px-5
      py-2.5
      rounded-lg
      shadow-sm
      transition-all
      duration-300
      focus:outline-none
      focus:shadow-lg
      focus:ring-4
      hover:shadow-lg
      hover:ring-4
    "
    :class="classes"
  >
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  color: {
    type: String,
    default: 'default'
  },
  disabled: {
    type: Boolean,
    default: false
  }
})

const classes = computed(() => {
  const colors = {
    primary: [
      'from-primary-500',
      'via-primary-600',
      'to-primary-700',
      'focus:ring-primary-300',
      'focus:shadow-primary-500/50',
      'hover:ring-primary-300',
      'hover:shadow-primary-500/50'
    ],
    success: [
      'from-success-500',
      'to-success-600',
      'focus:ring-success-300',
      'focus:shadow-success-500/50',
      'hover:ring-success-300',
      'hover:shadow-success-500/50'
    ],
    warning: [
      'from-warning-500',
      'to-warning-600',
      'focus:ring-warning-300',
      'focus:shadow-warning-500/50',
      'hover:ring-warning-300',
      'hover:shadow-warning-500/50'
    ],
    danger: [
      'from-danger-500',
      'to-danger-600',
      'focus:ring-danger-300',
      'focus:shadow-danger-500/50',
      'hover:ring-danger-300',
      'hover:shadow-danger-500/50'
    ],
    default: [
      'from-default-500',
      'via-default-600',
      'to-default-700',
      'focus:ring-default-400/50',
      'focus:shadow-default-500/50',
      'hover:ring-default-400/50',
      'hover:shadow-default-500/50'
    ]
  }[props.color]

  if (props.disabled) {
    colors.push('opacity-50')
  }

  return colors
})
</script>
