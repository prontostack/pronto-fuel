<template>
  <q-btn-toggle
    toggle-color="primary"
    unelevated
    size="sm"
    :options="[
      { value: 'left', slot: 'left' },
      { value: 'center', slot: 'center' },
      { value: 'right', slot: 'right' }
    ]"
  >
    <template #left>
      <div class="row items-center no-wrap">
        <i-mdi-format-align-left />
      </div>
    </template>

    <template #center>
      <div class="row items-center no-wrap">
        <i-mdi-format-align-center />
      </div>
    </template>

    <template #right>
      <div class="row items-center no-wrap">
        <i-mdi-format-align-right />
      </div>
    </template>
  </q-btn-toggle>
</template>

<script setup>

</script>

<style lang="scss" scoped>

</style>
