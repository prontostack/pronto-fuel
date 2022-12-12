<template layout="AppShell,Authenticated">
  <CenteredContainer>
    <AccountSection
      :title="passwordUpdateForm.trans.label"
      :hint="passwordUpdateForm.trans.hint"
    >
      <Form v-bind="passwordUpdateForm" />
    </AccountSection>

    <v-divider class="tw-my-10" />

    <AccountSection
      :title="twoFactorStatus.binds.trans.label"
      :hint="twoFactorStatus.binds.trans.hint"
    >
      <AccountTwoFactorStatus v-bind="twoFactorStatus.binds" />
    </AccountSection>
  </CenteredContainer>
</template>

<script setup>
defineProps({
  passwordUpdateForm: Object,
  twoFactorStatus: Object
})
</script>
