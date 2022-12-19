<template layout="AppShell,Admin">
  <v-container>
    <v-row>
      <v-col
        cols="12"
        sm="6"
        md="4"
        lg="3"
        xl="2"
      >
        <StatsCard v-bind="registeredUsersCard" />
      </v-col>
      <v-col
        cols="12"
        sm="6"
        md="4"
        lg="3"
        xl="2"
      >
        <StatsCard v-bind="registeredUsersCardTest" />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
const props = defineProps({
  registeredUsersCard: Object,
  registeredUsersCardTest: Object
})
</script>

<style lang="scss" scoped>

</style>
