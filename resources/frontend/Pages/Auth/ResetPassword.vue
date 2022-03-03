<template layout="Guest">
  <Head title="Reset Password" />

  <form
    class="tw-flex-col tw-space-y-2"
    @submit.prevent="form.post(route('password.update'))"
  >
    <q-input
      id="password"
      v-model="form.password"
      :error-message="errors.password"
      :error="!!errors.password"
      type="password"
      label="Password"

      autocomplete="new-password"
      outlined
    />

    <q-input
      id="password_confirmation"
      v-model="form.password_confirmation"
      :error-message="errors.password_confirmation"
      :error="!!errors.password_confirmation"
      label="Password confirmation"
      type="password"

      autocomplete="new-password"
      outlined
    />

    <div class="tw-flex tw-items-center tw-justify-end">
      <q-btn
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Reset Password
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
