<template>
  <q-dialog
    :model-value="show"
    maximized
    @hide="redirect"
  >
    <div class="tw-bg-white">
      <slot />
    </div>
  </q-dialog>
</template>
<script setup>
import { useModal } from 'momentum-modal'

const { show, redirect } = useModal()
</script>
