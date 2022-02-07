<template layout="Guest">
  <Head title="Confirm Password" />

  <div class="mb-4 text-sm text-gray-600">
    This is a secure area of the application. Please confirm your password before continuing.
  </div>

  <form @submit.prevent="submit">
    <div>
      <PInput
        id="password"
        v-model="form.password"
        :error-messages="errors.password"
        label="Password"
        type="password"
        required
        autocomplete="current-password"
        autofocus
      />
    </div>

    <div class="flex justify-end mt-4">
      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Confirm
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
  form.post(window.route('password.confirm'), {
    onFinish: () => form.reset()
  })
}
</script>
