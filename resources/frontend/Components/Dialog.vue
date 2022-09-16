<template>
  <q-dialog>
    <!-- pass through scoped slots -->
    <template
      v-for="(_, scopedSlotName) in $slots"
      #[scopedSlotName]="slotData"
    >
      <slot
        :name="scopedSlotName"
        v-bind="slotData"
      />
    </template>

    <!-- pass through normal slots -->
    <template
      v-for="(_, slotName) in $slots"
      #[slotName]
    >
      <slot :name="slotName" />
    </template>
  </q-dialog>
</template>

<script setup>

</script>
