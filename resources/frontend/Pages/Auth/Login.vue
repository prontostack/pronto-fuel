<template layout="AppShell,Guest">
  <div>
    <Head title="Login" />

    <AuthLogo />

    <Form v-bind="form">
      <template #submit="{ processing }">
        <div class="tw-flex tw-items-center tw-justify-between">
          <Link
            v-if="form.resetPasswordUrl"
            :href="form.resetPasswordUrl"
          >
            {{ form.trans.forgotPassword }}
          </Link>

          <v-btn
            :loading="processing"
            :disabled="processing"
            type="submit"
            color="primary"
          >
            {{ form.trans.login }}
          </v-btn>
        </div>
      </template>
    </Form>
  </div>
</template>

<script setup>
defineProps({
  form: Object
})
</script>
