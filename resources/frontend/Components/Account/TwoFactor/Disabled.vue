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
      <Btn
        color="primary"
        :label="trans.configure"
        @click="confirmEnable"
      />
    </ConfirmPassword>
  </div>
</template>

<script setup>
defineProps({
  enable: Object,
  trans: Object
})
</script>
