<template layout="Guest">
  <Head title="Register" />

  <form @submit.prevent="submit">
    <PInput
      id="name"
      v-model="form.name"
      :error-messages="errors.name"
      label="Name"
      type="text"
      autofocus
      autocomplete="name"
      required
    />

    <PInput
      id="email"
      v-model="form.email"
      :error-messages="errors.email"
      label="Email"
      type="email"
      autocomplete="username"
      required
    />

    <PInput
      id="password"
      v-model="form.password"
      :error-messages="errors.password"
      label="Password"
      type="password"
      autocomplete="new-password"
      required
    />

    <PInput
      id="password_confirmation"
      v-model="form.password_confirmation"
      :error-messages="errors.password_confirmation"
      label="Confirm Password"
      type="password"
      autocomplete="new-password"
      required
    />

    <div class="flex items-center justify-end mt-6">
      <Link
        :href="route('login')"
        class="text-sm"
      >
        Already registered?
      </Link>

      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
        class="ml-4"
      >
        Register
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

const submit = () => form.post(window.route('register'))
</script>
