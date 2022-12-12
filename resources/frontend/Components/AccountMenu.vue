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
          title="My Profile"
          :icon="mdiAccountOutline"
          to="account.profile"
        />
        <NavLink
          title="Preferences"
          :icon="mdiCogOutline"
          to="account.preferences"
        />
        <NavLink
          title="Security"
          :icon="mdiLockOutline"
          to="account.security"
        />

        <v-divider class="tw-mb-[3px]" />

        <NavLink
          title="Logout"
          :icon="mdiPowerStandby"
          to="logout"
          method="post"
        />
      </v-list>
    </v-menu>
  </div>
</template>

<script setup>
import { mdiAccountOutline, mdiPowerStandby, mdiCogOutline, mdiLockOutline } from '@mdi/js'

const user = usePage().props.value.auth.user
</script>
