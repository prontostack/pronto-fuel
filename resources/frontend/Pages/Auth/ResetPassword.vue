<template layout="Guest">
  <Head title="Reset Password" />

  <form @submit.prevent="submit">
    <PInput
      id="password"
      v-model="form.password"
      :error-messages="errors.password"
      type="password"
      label="Password"
      required
      autocomplete="new-password"
    />

    <PInput
      id="password_confirmation"
      v-model="form.password_confirmation"
      :error-messages="errors.password_confirmation"
      label="Password confirmation"
      type="password"
      required
      autocomplete="new-password"
    />

    <div class="flex items-center justify-end mt-4">
      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Reset Password
      </PButton>
    </div>
  </form>
</template>

<script setup>
const props = defineProps({
  form: Object,
  errors: Object
})

const form = useForm(props.form)

const submit = () => {
  form.post(window.route('password.update'), {
    onFinish: () => form.reset('password', 'password_confirmation')
  })
}
</script>
