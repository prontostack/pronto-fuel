<template>
  <CenteredContainer>
    <AccountSection
      :title="profileForm.trans.label"
      :hint="profileForm.trans.hint"
    >
      <Form v-bind="profileForm" />
    </AccountSection>
  </CenteredContainer>
</template>

<script setup>
const props = defineProps({
  profileForm: Object
})
</script>

<style lang="scss" scoped>

</style>
