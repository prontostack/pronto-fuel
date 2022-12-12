<template layout="AppShell,Guest">
  <div>
    <Head title="Register" />

    <AuthLogo />

    <Form v-bind="form">
      <template #submit="{ processing }">
        <div class="tw-flex tw-items-center tw-justify-between">
          <Link :href="form.loginUrl">
            {{ form.trans.alreadyRegistered }}
          </Link>

          <v-btn
            :disabled="processing"
            :loading="processing"
            type="submit"
            color="primary"
          >
            {{ form.trans.submit }}
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
