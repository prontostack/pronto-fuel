<template layout="AppShell,Guest">
  <div>
    <Head :title="trans.title" />

    <AuthLogo />

    <FormCard
      :title="trans.title"
      :hint="trans.hint"
      flat
      class="bg-transparent"
    >
      <Form
        v-if="useRecoveryCode"
        v-bind="recoveryForm"
      />
      <Form
        v-else
        v-bind="challengeForm"
      />
      <div class="text-center tw-mt-6">
        <Btn
          color="primary"
          flat
          size="sm"
          :label="trans.switchMethod"
          @click.stop="useRecoveryCode = !useRecoveryCode"
        />
      </div>
    </FormCard>
  </div>
</template>

<script setup>
const props = defineProps({
  challengeForm: Object,
  recoveryForm: Object
})

const useRecoveryCode = ref(false)

const trans = computed(() => useRecoveryCode.value ? props.recoveryForm.trans : props.challengeForm.trans)
</script>
