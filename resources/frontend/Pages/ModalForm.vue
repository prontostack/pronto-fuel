<template>
  <Modal>
    <Head
      v-if="form.trans?.title"
      :title="form.trans?.title"
    />
    <FormCard
      :title="form.trans?.title"
      :hint="form.trans?.hint"
    >
      <Form
        v-bind="form"
      />
    </FormCard>
  </Modal>
</template>

<script setup>
defineProps({
  form: Object
})
</script>
