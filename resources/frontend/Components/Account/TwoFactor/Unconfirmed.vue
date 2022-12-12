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
      <v-btn
        type="submit"
        color="primary"
        @click="askForChallenge = true"
      >
        {{ trans.enable }}
      </v-btn>
      <v-dialog
        v-model="askForChallenge"
        max-width="400"
      >
        <FormCard
          :title="confirm.trans.title"
          :hint="confirm.trans.hint"
        >
          <Form
            v-bind="confirm"
            id="confirmTwoFactorAuthentication"
          />
        </FormCard>
      </v-dialog>
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
