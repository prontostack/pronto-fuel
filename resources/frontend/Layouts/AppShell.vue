<template>
  <div>
    <FadeTransition>
      <slot />
    </FadeTransition>
    <Modal />
    <Toasts />
    <q-ajax-bar
      ref="loadingIndicator"
      position="top"
      color="accent"
      size="4px"
      skip-hijack
    />
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Modal } from 'momentum-modal'
import { useAppShell } from '@/store/app-shell'

const { setDarkMode } = useAppShell()

setDarkMode()

const loadingIndicator = ref(null)

Inertia.on('start', () => loadingIndicator.value.start())
Inertia.on('finish', () => loadingIndicator.value.stop())
</script>
