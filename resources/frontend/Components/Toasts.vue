<template>
  <notifications
    class="min-w-[300px] p-0 bg-none border-none m-6"
    position="bottom right"
  >
    <template
      #body="{ item, close }"
    >
      <PAlert
        class="m-2"
        :type="item.type"
        @dismiss="close"
      >
        {{ item.text }}
      </PAlert>
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
    console.log('test')
    notify(toast)
  })
}

onMounted(() => renderToasts(toasts.value))

watch(toasts, (newToasts) => {
  renderToasts(newToasts)
})
</script>
