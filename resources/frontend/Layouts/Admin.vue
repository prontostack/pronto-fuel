<template>
  <v-app :theme="darkMode.enabled ? 'dark' : 'light'">
    <AdminNavDrawer />

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
        <span class="tw-inline-block tw-mr-8">{{ $page.props.title }}</span>
        <PortalTarget name="contextual-actions" />
      </v-app-bar-title>

      <template #append>
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
