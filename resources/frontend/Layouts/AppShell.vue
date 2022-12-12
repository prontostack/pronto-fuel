<template>
  <div>
    <Head :title="$page.props.title" />
    <FadeTransition>
      <slot />
    </FadeTransition>
    <Modal />
    <Toasts />
    <div
      v-if="loading"
      class="tw-fixed tw-top-0 tw-left-0 tw-right-0 tw-z-[10000]"
    >
      <v-progress-linear
        indeterminate
        height="3"
        color="primary-lighten-1"
      />
    </div>
  </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia'
import { Modal } from 'momentum-modal'
import { useDarkMode } from '@/store/dark-mode'

const { setDarkMode } = useDarkMode()

setDarkMode()

const loading = ref(false)

Inertia.on('start', () => { loading.value = true })
Inertia.on('finish', () => { loading.value = false })
</script>

<style lang="scss">
.v-messages__message {
  margin-bottom: 12px;
}
</style>
