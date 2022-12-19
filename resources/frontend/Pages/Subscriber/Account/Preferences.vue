<template layout="AppShell,Subscriber">
  <AccountPreferences :trans="trans" />
</template>

<script setup>
const props = defineProps({
  trans: Object
})
</script>
