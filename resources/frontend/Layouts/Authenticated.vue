<template>
  <v-app :theme="darkMode.enabled ? 'dark' : 'light'">
    <NavDrawer />

    <v-app-bar
      color="app-bar"
      density="compact"
      inverted-scroll
    >
      <template #prepend>
        <v-app-bar-nav-icon
          @click="drawer.toggle"
        />
      </template>

      <v-app-bar-title>
        <span>{{ $page.props.title }}</span>
      </v-app-bar-title>

      <template #append>
        <PortalTarget name="contextual-actions" />
        <AccountMenu />
      </template>
    </v-app-bar>

    <v-main>
      <FadeTransition>
        <slot />
      </FadeTransition>
    </v-main>
  </v-app>
</template>

<script setup>
import { useDarkMode } from '@/store/dark-mode'
import { useNavDrawer } from '@/store/nav-drawer'

const darkMode = useDarkMode()

const drawer = useNavDrawer()
</script>
