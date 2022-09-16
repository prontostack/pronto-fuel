<template layout="AppShell,Authenticated">
  <div class="tw-max-w-4xl q-pa-xl tw-mx-auto">
    <Head :title="title" />

    <AccountSection
      :title="profileForm.trans.label"
      :hint="profileForm.trans.hint"
    >
      <Form v-bind="profileForm" />
    </AccountSection>

    <q-separator class="q-my-xl" />

    <AccountSection
      :title="passwordUpdateForm.trans.label"
      :hint="passwordUpdateForm.trans.hint"
    >
      <Form v-bind="passwordUpdateForm" />
    </AccountSection>

    <q-separator class="q-my-xl" />

    <AccountSection
      :title="twoFactorStatus.binds.trans.label"
      :hint="twoFactorStatus.binds.trans.hint"
    >
      <AccountTwoFactorStatus v-bind="twoFactorStatus.binds" />
    </AccountSection>

    <q-separator class="q-my-xl" />
  </div>
</template>

<script setup>
defineProps({
  title: String,
  profileForm: Object,
  passwordUpdateForm: Object,
  twoFactorStatus: Object
})
</script>
