<template>
  <div class="flex items-center">
    <label class="flex items-center">
      <input
        v-model="proxyChecked"
        v-bind="$attrs"
        type="checkbox"
        class="
          w-5
          h-5
          rounded
          border-gray-300
          transition-all
          shadow-sm
          text-primary-600
          focus:border-primary-300
          focus:ring
          focus:ring-primary-200
          focus:ring-opacity-50
        "
      >
      <span class="ml-2 text-base text-gray-600">
        {{ label }}
      </span>
    </label>
  </div>
</template>

<script>
export default {
  inheritAttrs: false
}
</script>

<script setup>
const props = defineProps({
  modelValue: {
    type: [Array, Boolean],
    default: false
  },
  label: String
})

const emit = defineEmits(['update:modelValue'])

const proxyChecked = computed({
  get () {
    return props.modelValue
  },
  set (val) {
    emit('update:modelValue', val)
  }
})
</script>
