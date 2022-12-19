<template>
  <v-btn
    variant="tonal"
    :prepend-icon="mdiPlus"
    @click.stop="navigate"
  >
    {{ label }}
  </v-btn>
</template>

<script setup>
import { mdiPlus } from '@mdi/js'

const props = defineProps({
  label: String,
  href: String
})

const navigate = () => {
  Inertia.get(props.href)
}
</script>

<style lang="scss" scoped>

</style>
