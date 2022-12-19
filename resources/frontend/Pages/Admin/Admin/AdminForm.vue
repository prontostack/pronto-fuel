<template layout="AppShell,Admin">
  <CenteredContainer>
    <Form v-bind="adminForm" />
  </CenteredContainer>
</template>

<script setup>
const props = defineProps({
  adminForm: Object
})
</script>

<style lang="scss" scoped>

</style>
