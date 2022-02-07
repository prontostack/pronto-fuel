<template>
  <div class="relative mb-6">
    <input
      v-bind="$attrs"
      ref="input"
      :value="modelValue"
      class="
        peer
        py-3
        border-gray-300
        rounded-md
        shadow-sm
        placeholder-transparent
        focus:ring-4
        focus:ring-primary-300/20
        focus:border-primary-400
        focus:shadow-lg
        transition-all
        duration-300
      "
      :class="{
        'block w-full': !inline,
        'bg-danger-50 text-danger-500 border border-danger-500 focus:ring-danger-300/20 focus:border-danger-400': invalid
      }"
      :placeholder="label"
      @input="$emit('update:modelValue', $event.target.value)"
    >
    <label
      v-if="label"
      :for="$attrs.id"
      class="
        absolute
        -top-2
        left-3
        px-2
        rounded-full
        text-xs
        bg-white
        cursor-text
        peer-placeholder-shown:left-[5px]
        peer-placeholder-shown:top-[13px]
        peer-placeholder-shown:text-base
        peer-placeholder-shown:bg-transparent
        peer-focus:left-3
        peer-focus:-top-2
        peer-focus:text-xs
        peer-focus:text-white
        peer-focus:bg-primary-400
        peer-placeholder-shown:text-gray-900
        transition-all
      "
      :class="{
        'text-danger-500': invalid,
        'peer-focus:text-white': invalid,
        'peer-focus:bg-danger-500': invalid,
        'peer-placeholder-shown:text-danger-500': invalid
      }"
    >
      {{ label }}
    </label>
    <PInputError
      v-for="message in displayErrors"
      :key="message"
    >
      {{ message }}
    </PInputError>
  </div>
</template>

<script>
export default {
  inheritAttrs: false
}
</script>

<script setup>
const input = ref(null)

defineEmits(['update:modelValue'])

const props = defineProps({
  inline: Boolean,
  modelValue: [String, Number],
  label: String,
  errorMessages: {
    type: [Array, String],
    default: () => ([])
  }
})

const displayErrors = computed(() => {
  if (typeof props.errorMessages === 'string') {
    return [props.errorMessages]
  }

  return props.errorMessages
})

const invalid = computed(() => {
  return !!displayErrors.value.length
})

const focus = () => {
  input.focus()
}
</script>
