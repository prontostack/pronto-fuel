<template>
  <form
    :action="action"
    :method="method"
    class="tw-space-y-4"
    @submit.prevent="submit"
  >
    <div
      v-for="field in fields"
      :key="`field-${field.model}`"
    >
      <component
        :is="field.component"
        v-model="form[field.model]"
        v-bind="field.binds"
        :error="errors[field.model]"
      />
    </div>
    <q-btn
      color="primary"
      type="submit"
    >
      Submit
    </q-btn>
  </form>
</template>

<script>
import { v4 as uuid } from 'uuid'

const components = {}

const imports = import.meta.glob('../Fields/*.vue')

Object.keys(imports).forEach((filePath) => {
  const componentName = filePath.replace(/^.*[\\\/]/, '').replace(/\.[^/.]+$/, '')

  components[componentName] = defineAsyncComponent(imports[filePath])
})

export default {
  components
}
</script>

<script setup>
const props = defineProps({
  action: String,
  method: String,
  fields: Array,
  resetOnSuccess: Boolean
})

const formId = uuid()

const formData = {
  _method: props.method
}

props.fields.forEach((field) => {
  formData[field.model] = field.value
})

const form = useForm(formData)

const submit = () => {
  form.post(props.action, {
    errorBag: formId,
    onSuccess: () => {
      if (props.resetOnSuccess === true) {
        form.reset()
      }
    }
  })
}

const errors = computed(() => usePage().props.value?.errors[formId] || {})
</script>
