<template layout="AppShell,Authenticated">
  <div class="tw-max-w-4xl q-pa-xl tw-mx-auto">
    <Head :title="title" />
    <Form
      id="post-form"
      v-bind="postForm"
    />
    <Portal to="contextual-actions">
      <Btn
        label="Save"
        color="primary"
        form="post-form"
        type="submit"
      />
    </Portal>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  postForm: Object
})
</script>
