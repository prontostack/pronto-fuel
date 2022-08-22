<template layout="AppShell,Guest">
  <div>
    <Head title="Confirm Password" />

    <AuthLogo />

    <div class="tw-mb-4 tw-text-sm tw-opacity-60">
      This is a secure area of the application. Please confirm your password before continuing.
    </div>

    <form @submit.prevent="form.post(route('password.confirm'))">
      <q-input
        id="password"
        v-model="form.password"
        :error-message="errors.password"
        :error="!!errors.password"
        label="Password"
        type="password"
        required
        autocomplete="current-password"
        autofocus
        outlined
      />

      <div class="tw-flex tw-justify-end tw-mt-4">
        <q-btn
          :disabled="form.processing"
          type="submit"
          color="primary"
        >
          Confirm
        </q-btn>
      </div>
    </form>
  </div>
</template>

<script setup>
const props = defineProps({
  form: Object,
  errors: Object
})

const form = useForm(props.form)
</script>
