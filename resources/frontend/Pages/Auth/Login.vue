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

          <q-btn
            :loading="processing"
            :disabled="processing"
            type="submit"
            color="primary"
            class="ml-4"
          >
            {{ form.trans.login }}
          </q-btn>
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
