<template layout="Guest">
  <Head title="Login" />

  <form @submit.prevent="form.post(route('login'))">
    <PInput
      id="email"
      v-model="form.email"
      :error-messages="errors.email"
      label="Email"
      type="email"
      autofocus
      autocomplete="username"
      required
    />

    <PInput
      id="password"
      v-model="form.password"
      :error-messages="errors.password"
      label="Password"
      type="password"
      autocomplete="current-password"
      required
    />

    <PCheckbox
      v-model="form.remember"
      label="Remember me"
    />

    <div class="flex items-center justify-end mt-6">
      <Link
        v-if="canResetPassword"
        :href="route('password.request')"
        class="text-sm"
      >
        Forgot your password?
      </Link>

      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
        class="ml-4"
      >
        Log in
      </PButton>
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
