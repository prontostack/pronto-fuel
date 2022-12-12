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
            <v-btn
              :disabled="processing"
              :loading="processing"
              type="submit"
              color="primary"
            >
              {{ form.trans.submit }}
            </v-btn>

            <Link
              :href="form.logoutUrl"
              method="post"
              as="button"
            >
              <v-btn
                type="button"
                variant="text"
              >
                {{ form.trans.logout }}
              </v-btn>
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
