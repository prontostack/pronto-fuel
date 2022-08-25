<template layout="AppShell,Authenticated">
  <div class="tw-container q-pa-xl tw-mx-auto">
    <Head :title="title" />

    <AccountSection
      :title="$t('account.profile.label')"
      :hint="$t('account.profile.hint')"
    >
      <Form v-bind="profileForm" />
    </AccountSection>

    <q-separator class="q-my-xl" />

    <AccountSection
      :title="$t('account.password.label')"
      :hint="$t('account.password.hint')"
    >
      <Form v-bind="passwordForm" />
    </AccountSection>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  profileForm: Object,
  passwordForm: Object
})
</script>
