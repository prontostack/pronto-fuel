<template>
  <div>
    <div class="tw-mb-4">
      <strong
        class="tw-block tw-text-lg tw-mb-2"
        v-text="trans.disabled.label"
      />
      <span
        class="tw-block tw-text-base"
        v-html="trans.disabled.hint"
      />
    </div>
    <ConfirmPassword
      v-slot="{ confirm: confirmEnable }"
      v-bind="enable.binds"
    >
      <v-btn
        color="primary"
        :stacked="xs"
        @click="confirmEnable"
      >
        {{ trans.configure }}
      </v-btn>
    </ConfirmPassword>
  </div>
</template>

<script setup>
const { xs } = useDisplay()

defineProps({
  enable: Object,
  trans: Object
})
</script>
