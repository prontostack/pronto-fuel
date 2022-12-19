<template layout="AppShell,Admin">
  <AccountProfile :profile-form="profileForm" />
</template>

<script setup>
const props = defineProps({
  profileForm: Object
})
</script>

<style lang="scss" scoped>

</style>
