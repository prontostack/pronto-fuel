<template layout="AppShell,Authenticated">
  <div class="tw-max-w-4xl q-pa-xl tw-mx-auto">
    <Head :title="title" />
    <Form
      id="post-form"
      v-bind="postForm"
    />
    <Portal to="contextual-actions">
      <v-btn
        icon
        form="post-form"
        type="submit"
        class="tw-mx-4"
      >
        <v-icon :icon="mdiContentSaveOutline" />
        <v-tooltip
          activator="parent"
          location="bottom"
        >
          Save
        </v-tooltip>
      </v-btn>
    </Portal>
  </div>
</template>

<script setup>
import { mdiContentSaveOutline } from '@mdi/js'

defineProps({
  title: String,
  postForm: Object
})
</script>
