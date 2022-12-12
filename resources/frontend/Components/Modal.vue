<template>
  <v-dialog
    :model-value="show"
    @update:model-value="(val) => {
      if (val) return
      redirect()
    }"
  >
    <slot />
  </v-dialog>
</template>
<script setup>
import { useModal } from 'momentum-modal'

const { show, redirect } = useModal()
</script>
