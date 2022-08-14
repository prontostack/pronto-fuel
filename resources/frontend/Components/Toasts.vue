<template>
  <notifications
    class="tw-min-w-[300px] tw-p-0 tw-bg-none tw-border-none tw-m-6"
    position="bottom right"
  >
    <template
      #body="{ item, close }"
    >
      <Alert
        class="tw-m-2"
        :type="item.type"
        @dismiss="close"
      >
        {{ item.text }}
      </Alert>
    </template>
  </notifications>
</template>

<script setup>
import { notify } from '@kyvg/vue3-notification'

const $page = usePage()

const toasts = computed(() => {
  return $page.props.value.toasts
})

const renderToasts = (toastsSource) => {
  toastsSource.forEach((toast) => {
    notify(toast)
  })
}

onMounted(() => renderToasts(toasts.value))

watch(toasts, (newToasts) => {
  renderToasts(newToasts)
})
</script>
