<template>
  <v-list-item
    density="compact"
    :prepend-icon="icon"
    :title="label"
    :active="active"
    @click="navigate"
  />
</template>

<script setup>
const props = defineProps({
  active: Boolean,
  label: String,
  icon: String,
  to: String,
  method: {
    type: String,
    default: 'get'
  }
})

const emit = defineEmits(['navigate'])

const navigate = () => {
  emit('navigate')

  Inertia.visit(props.to, {
    method: props.method
  })
}
</script>
