<template layout="AppShell,Admin">
  <AccountPreferences :trans="trans" />
</template>

<script setup>
const props = defineProps({
  trans: Object
})
</script>
