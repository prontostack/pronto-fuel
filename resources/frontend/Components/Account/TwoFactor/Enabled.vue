<template>
  <div>
    <div class="tw-mb-4">
      <strong
        class="tw-block tw-text-lg tw-mb-2"
        v-text="trans.enabled.label"
      />
      <span
        class="tw-block tw-text-base"
        v-html="trans.enabled.hint"
      />
    </div>

    <div class="tw-mb-5">
      <div v-if="recoveryCodes">
        <strong
          class="tw-block tw-text-lg tw-mb-2"
          v-text="trans.recoveryCodes.label"
        />
        <span
          class="tw-block tw-text-base tw-mb-3"
          v-text="trans.recoveryCodes.hint"
        />
        <div class="tw-flex tw-flex-col tw-space-y-1 tw-rounded tw-bg-black/5 dark:tw-bg-black/30 tw-py-2 tw-px-3 tw-mb-5">
          <span
            v-for="code in recoveryCodes"
            :key="`key-${code}`"
            class="tw-block tw-font-semibold tw-text-sm tw-font-mono"
            v-text="code"
          />
        </div>
        <ConfirmPassword
          v-slot="{ confirm: confirmRegenerateRecoveryCodes }"
          v-bind="regenerateRecoveryCodes.binds"
        >
          <Btn
            outlined
            :label="trans.recoveryCodes.regenerate"
            @click="confirmRegenerateRecoveryCodes"
          />
        </ConfirmPassword>
      </div>
      <div v-else>
        <ConfirmPassword
          v-slot="{ confirm: confirmShowRecoveryCodes }"
          v-bind="showRecoveryCodes.binds"
          @confirmed="Inertia.reload()"
        >
          <Btn
            color="primary"
            :label="trans.recoveryCodes.show"
            @click="confirmShowRecoveryCodes"
          />
        </ConfirmPassword>
      </div>
    </div>

    <ConfirmPassword
      v-slot="{ confirm: confirmDisable }"
      v-bind="disable.binds"
    >
      <Btn
        outlined
        color="negative"
        :label="trans.disable"
        @click="confirmDisable"
      />
    </ConfirmPassword>
  </div>
</template>

<script setup>
defineProps({
  disable: Object,
  recoveryCodes: Array,
  regenerateRecoveryCodes: Object,
  showRecoveryCodes: Object,
  trans: Object
})
</script>
