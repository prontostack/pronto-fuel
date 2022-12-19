<template>
  <div class="tw-relative">
    <v-menu
      transition="slide-y-transition"
    >
      <template #activator="{ props }">
        <v-btn
          icon
          variant="text"
        >
          <v-avatar v-bind="props">
            <v-img :src="user.avatar" />
          </v-avatar>
        </v-btn>
      </template>

      <v-list
        nav
        density="compact"
      >
        <NavLink
          v-for="link in menu.items"
          :key="link.key"
          v-bind="link"
          :icon="icons[link.icon]"
        />

        <v-divider class="tw-mb-[3px]" />

        <NavLink
          v-bind="menu.logout"
          :icon="icons[menu.logout.icon]"
        />
      </v-list>
    </v-menu>
  </div>
</template>

<script setup>
import {
  mdiAccountOutline,
  mdiPowerStandby,
  mdiCogOutline,
  mdiSecurity
} from '@mdi/js'

const icons = {
  mdiAccountOutline,
  mdiPowerStandby,
  mdiCogOutline,
  mdiSecurity
}

const user = computed(() => usePage().props.value.auth.user)
const menu = computed(() => usePage().props.value.layout.account_menu)
</script>
