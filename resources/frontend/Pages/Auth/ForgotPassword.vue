<template layout="Guest">
  <Head title="Forgot Password" />

  <div class="tw-mb-6 tw-text-gray-600">
    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
  </div>

  <form
    class="tw-flex-col tw-space-y-2"
    @submit.prevent="form.post(route('password.email'))"
  >
    <q-input
      id="email"
      v-model="form.email"
      :error-message="errors.email"
      :error="!!errors.email"
      label="Email"
      type="email"
      required
      autofocus
      autocomplete="username"
      outlined
    />

    <div class="tw-flex tw-items-center tw-justify-end">
      <q-btn
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Email Password Reset Link
      </q-btn>
    </div>
  </form>
</template>

<script setup>
const props = defineProps({
  form: Object,
  errors: Object
})

const form = useForm(props.form)
</script>
