<template layout="Guest">
  <Head title="Login" />

  <form
    class="tw-flex-col tw-space-y-2"
    @submit.prevent="form.post(route('login'))"
  >
    <q-input
      id="email"
      v-model="form.email"
      :error-message="errors.email"
      :error="!!errors.email"
      label="Email"
      type="email"
      autofocus
      autocomplete="username"
      required
      outlined
    />

    <q-input
      id="password"
      v-model="form.password"
      :error-message="errors.password"
      :error="!!errors.password"
      label="Password"
      type="password"
      autocomplete="current-password"
      required
      outlined
    />

    <q-checkbox
      v-model="form.remember"
      label="Remember me"
    />

    <div class="tw-flex tw-items-center tw-justify-between">
      <Link
        v-if="canResetPassword"
        :href="route('password.request')"
      >
        Forgot your password?
      </Link>

      <q-btn
        :disabled="form.processing"
        type="submit"
        color="primary"
        class="ml-4"
      >
        Log in
      </q-btn>
    </div>
  </form>
</template>

<script setup>
const props = defineProps({
  canResetPassword: Boolean,
  status: String,
  form: Object,
  errors: Object
})

const form = useForm(props.form)
</script>
