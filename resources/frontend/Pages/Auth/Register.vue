<template layout="Guest">
  <Head title="Register" />

  <form
    class="tw-flex-col tw-space-y-2"
    @submit.prevent="form.post(route('register'))"
  >
    <q-input
      id="name"
      v-model="form.name"
      :error-message="errors.name"
      :error="!!errors.name"
      label="Name"
      type="text"
      autofocus
      autocomplete="name"
      required
      outlined
    />

    <q-input
      id="email"
      v-model="form.email"
      :error-message="errors.email"
      :error="!!errors.email"
      label="Email"
      type="email"
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
      autocomplete="new-password"
      required
      outlined
    />

    <q-input
      id="password_confirmation"
      v-model="form.password_confirmation"
      :error-message="errors.password_confirmation"
      :error="!!errors.password_confirmation"
      label="Confirm Password"
      type="password"
      autocomplete="new-password"
      required
      outlined
    />

    <div class="tw-flex tw-items-center tw-justify-between">
      <Link :href="route('login')">
        Already registered?
      </Link>

      <q-btn
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Register
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
