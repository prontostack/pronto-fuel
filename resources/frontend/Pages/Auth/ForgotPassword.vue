<template layout="Guest">
  <Head title="Forgot Password" />

  <div class="mb-4 text-gray-600">
    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
  </div>

  <form @submit.prevent="submit">
    <PInput
      id="email"
      v-model="form.email"
      :error-messages="errors.email"
      label="Email"
      type="email"
      required
      autofocus
      autocomplete="username"
    />

    <div class="flex items-center justify-end mt-4">
      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Email Password Reset Link
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
  form.post(window.route('password.email'))
}
</script>
