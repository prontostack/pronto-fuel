<template layout="AppShell,Admin">
  <v-container>
    <v-row>
      <v-col>
        <DataTable v-bind="adminDataTable" />
        <Portal to="contextual-actions">
          <BtnAdd
            :href="adminDataTable.url_to_create"
            label="Criar"
          />
        </Portal>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
const props = defineProps({
  adminDataTable: Object
})
</script>

<style lang="scss" scoped>

</style>
