<template>
  <component
    :is="confirmPassword ? ConfirmPassword : 'div'"
    v-bind="confirmPassword ? confirmPassword.binds : {}"
    v-slot="confirmation"
    @confirmed="submit"
  >
    <form
      v-bind="$attrs"
      :action="action"
      :method="method"
      class="tw-space-y-4"
      @submit.prevent="handlePasswordConfirmation(confirmation?.confirm)"
    >
      <template v-if="fields">
        <div
          v-for="field in fields"
          :key="`field-${field.model}`"
        >
          <component
            :is="field.component"
            v-model="form[field.model]"
            v-bind="field.binds"
            :error="errors[field.model]"
            @submit-form="handlePasswordConfirmation(confirmation?.confirm)"
          />
        </div>
      </template>
      <slot
        name="submit"
        v-bind="form"
      >
        <Btn
          v-if="!hideSubmit"
          :disabled="form.processing"
          :loading="form.processing"
          color="primary"
          type="submit"
          :label="trans.submit"
        />
      </slot>
    </form>
  </component>
</template>

<script>
import { v4 as uuid } from 'uuid'
import ConfirmPassword from '@/Components/ConfirmPassword.vue'

const components = {}

const imports = import.meta.glob('../Fields/*.vue')

Object.keys(imports).forEach((filePath) => {
  const componentName = filePath.replace(/^.*[\\\/]/, '').replace(/\.[^/.]+$/, '')

  components[componentName] = defineAsyncComponent(imports[filePath])
})

export default {
  components,
  inheritAttrs: false
}
</script>

<script setup>
const props = defineProps({
  action: String,
  method: String,
  fields: Array,
  confirmPassword: Object,
  resetOnSuccess: Boolean,
  hideSubmit: Boolean,
  trans: Object,
  options: {
    type: Object,
    default: () => ({})
  }
})

const emit = defineEmits(['success'])

const formId = useAttrs().id || uuid()

const formData = {
  _method: props.method
}

if (props.fields) {
  props.fields.forEach((field) => {
    formData[field.model] = field.value
  })
}

const form = useForm(formData)

const errors = computed(() => usePage().props.value?.errors[formId] || {})

const submit = () => {
  form.post(props.action, {
    preserveScroll: true,
    errorBag: formId,
    onSuccess: () => {
      emit('success')

      if (props.resetOnSuccess === true) {
        form.reset()
      }
    },
    ...props.options
  })
}

const handlePasswordConfirmation = (confirm) => {
  if (typeof confirm === 'function') {
    return confirm()
  }

  submit()
}
</script>
