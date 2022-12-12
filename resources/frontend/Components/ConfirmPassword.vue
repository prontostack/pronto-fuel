<template>
  <div>
    <slot :confirm="getPasswordConfirmStatus" />
    <v-dialog
      v-model="askForPassword"
      max-width="400"
    >
      <FormCard
        :title="confirmPasswordForm.trans?.title"
        :hint="confirmPasswordForm.trans?.hint"
      >
        <Form
          v-bind="confirmPasswordForm"
          @success="handleConfirmed"
        />
      </FormCard>
    </v-dialog>
  </div>
</template>

<script setup>
import axios from 'axios'

const props = defineProps({
  action: String,
  confirmPasswordForm: Object,
  method: {
    type: String,
    default: 'get'
  },
  statusUrl: String
})

const emit = defineEmits([
  'confirmed'
])

const askForPassword = ref(false)

const runAction = () => {
  Inertia.visit(props.action, {
    method: props.method,
    preserveState: true,
    preserveScroll: true
  })
}

const getPasswordConfirmStatus = () => {
  axios.get(props.statusUrl).then(({ data }) => {
    if (data.confirmed) {
      return handleConfirmed()
    }

    askForPassword.value = true
  })
}

const handleConfirmed = () => {
  askForPassword.value = false
  emit('confirmed')

  if (props.action) {
    return runAction()
  }
}
</script>
