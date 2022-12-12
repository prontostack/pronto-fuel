<template>
  <notifications
    class="tw-min-w-[300px] tw-p-0 tw-bg-none tw-border-none tw-mb-3 sm:tw-m-6"
    :position="xs ? 'bottom center' : 'bottom right'"
  >
    <template
      #body="{ item, close }"
    >
      <v-alert
        :type="item.type"
        class="tw-m-2"
        @update:model-value="(val) => {
          if (val) return
          close()
        }"
      >
        <div class="tw-flex">
          <div>{{ item.text }}</div>
          <v-btn
            icon
            variant="text"
            size="x-small"
            @click="close"
          >
            <i-mdi-close />
          </v-btn>
        </div>
      </v-alert>
    </template>
  </notifications>
</template>

<script setup>
import { notify } from '@kyvg/vue3-notification'

const { xs } = useDisplay()

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
