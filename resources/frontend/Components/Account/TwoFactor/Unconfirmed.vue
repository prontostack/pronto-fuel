<template>
  <div class="tw-flex tw-flex-col tw-space-y-8">
    <div>
      <strong
        class="tw-block tw-text-lg tw-mb-2"
        v-text="trans.readQrCode.label"
      />
      <span class="tw-block tw-text-base tw-mb-3">
        {{ trans.readQrCode.hint }} "{{ trans.enable }}".
      </span>
      <div class="tw-block tw-mb-3">
        <div
          class="tw-inline-block tw-border tw-rounded"
          v-html="qrCode"
        />
      </div>
      <Btn
        type="submit"
        color="primary"
        :label="trans.enable"
        @click="askForChallenge = true"
      />
      <Dialog v-model="askForChallenge">
        <FormCard
          :title="confirm.trans.title"
          :hint="confirm.trans.hint"
        >
          <Form
            v-bind="confirm"
            id="confirmTwoFactorAuthentication"
          />
        </FormCard>
      </Dialog>
    </div>
  </div>
</template>

<script setup>
defineProps({
  qrCode: String,
  confirm: Object,
  trans: Object
})

const askForChallenge = ref(false)
</script>
