<template layout="Guest">
  <Head title="Email Verification" />

  <div class="mb-4 text-gray-600">
    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
  </div>

  <form @submit.prevent="submit">
    <div class="mt-4 flex items-center justify-between">
      <PButton
        :disabled="form.processing"
        type="submit"
        color="primary"
      >
        Resend Verification Email
      </PButton>

      <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="text-sm"
      >
        Log Out
      </Link>
    </div>
  </form>
</template>

<script setup>
const form = useForm()

const submit = () => {
  form.post(window.route('verification.send'))
}
</script>
