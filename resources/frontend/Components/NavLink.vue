<template>
  <v-list-item
    :prepend-icon="icon"
    :title="title"
    :active="active"
    @click="navigate"
  />
</template>

<script setup>
const props = defineProps({
  title: String,
  icon: String,
  to: String,
  method: {
    type: String,
    default: 'get'
  }
})

const emit = defineEmits(['navigate'])

const $page = usePage()

const active = computed(() => {
  return props.to === $page.props.value.current_route
})

const navigate = () => {
  if (active.value) {
    return
  }

  emit('navigate')

  Inertia.visit(window.route(props.to), {
    method: props.method
  })
}
</script>
