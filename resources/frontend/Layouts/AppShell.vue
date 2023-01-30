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
import { Modal } from 'momentum-modal'
import { useAppShell } from '@/store/app-shell'

const { setDarkMode } = useAppShell()

setDarkMode()

const loadingIndicator = ref(null)

router.on('start', () => loadingIndicator.value.start())
router.on('finish', () => loadingIndicator.value.stop())
</script>
