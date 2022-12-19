<template layout="AppShell,Subscriber">
  <AccountSecurity
    :password-update-form="passwordUpdateForm"
    :two-factor-status="twoFactorStatus"
  />
</template>

<script setup>
defineProps({
  passwordUpdateForm: Object,
  twoFactorStatus: Object
})
</script>
