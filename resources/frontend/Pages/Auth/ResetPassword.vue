<template layout="AppShell,Guest">
  <div>
    <Head :title="form.trans.title" />

    <AuthLogo />

    <FormCard
      :title="form.trans.title"
      flat
      class="bg-transparent"
    >
      <Form v-bind="form" />
    </FormCard>
  </div>
</template>

<script setup>
defineProps({
  form: Object
})
</script>
