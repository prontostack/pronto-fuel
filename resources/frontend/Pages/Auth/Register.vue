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

          <Btn
            :disabled="processing"
            :loading="processing"
            :label="form.trans.submit"
            type="submit"
            color="primary"
          />
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
