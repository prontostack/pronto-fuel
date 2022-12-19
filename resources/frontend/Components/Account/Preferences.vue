<template>
  <CenteredContainer>
    <AccountSection
      :title="trans.dark_mode.title"
      :hint="trans.dark_mode.hint"
    >
      <v-switch
        v-model="dark"
        :label="trans.dark_mode.label"
      />
    </AccountSection>
  </CenteredContainer>
</template>

<script setup>
import { useDarkMode } from '@/store/dark-mode'

const props = defineProps({
  trans: Object
})

const darkMode = useDarkMode()

const dark = computed({
  get () {
    return darkMode.enabled
  },
  set () {
    darkMode.toggle()
  }
})
</script>
