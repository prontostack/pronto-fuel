<template layout="AppShell,Guest">
  <div>
    <Head :title="form.trans.title" />

    <AuthLogo />

    <FormCard
      :title="form.trans.title"
      :hint="form.trans.hint"
      flat
      class="bg-transparent"
    >
      <Form v-bind="form">
        <template #submit="{ processing }">
          <div class="tw-mt-4 tw-flex tw-items-center tw-justify-between">
            <Btn
              :disabled="processing"
              :loading="processing"
              :label="form.trans.submit"
              type="submit"
              color="primary"
            />

            <Link
              :href="form.logoutUrl"
              method="post"
              as="button"
            >
              <Btn
                :label="form.trans.logout"
                type="button"
                flat
              />
            </Link>
          </div>
        </template>
      </Form>
    </FormCard>
  </div>
</template>

<script setup>
defineProps({
  form: Object
})
</script>
