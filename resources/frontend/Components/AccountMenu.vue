<template>
  <q-btn
    flat
    stretch
  >
    <div class="row items-center no-wrap">
      <q-avatar size="32px">
        <img :src="user.avatar">
      </q-avatar>
    </div>

    <q-menu
      v-model="isOpen"
      transition-show="jump-down"
      transition-hide="jump-up"
      anchor="bottom right"
      self="top right"
      max-width="260px"
    >
      <div class="tw-flex tw-items-center tw-p-4">
        <q-avatar
          size="32px"
          class="tw-mr-4"
        >
          <img :src="user.avatar">
        </q-avatar>
        <div class="tw-opacity-60">
          <span class="tw-block tw-font-semibold">{{ user.name }}</span>
          <span class="tw-block tw-text-xs">{{ user.email }}</span>
        </div>
      </div>
      <q-separator />
      <NavList class="tw-w-full">
        <NavLink
          :href="route('account.index')"
          :active="route().current('account.index')"
        >
          <template #icon>
            <i-mdi-account-outline />
          </template>
          My Account
        </NavLink>
        <q-separator spaced />
        <q-toggle
          v-model="dark"
          color="deep-purple-4"
        >
          <span class="tw-opacity-60">Dark Mode</span>
        </q-toggle>
        <q-separator spaced />
        <NavLink
          :href="route('logout')"
          method="post"
          as="button"
        >
          <template #icon>
            <i-mdi-power-standby />
          </template>
          Logout
        </NavLink>
      </NavList>
    </q-menu>
  </q-btn>
</template>

<script setup>
import { useAppShell } from '@/store/app-shell'

const { settings, toggleDarkMode } = useAppShell()

const dark = computed({
  get () {
    return settings.isDark
  },
  set () {
    toggleDarkMode()
  }
})

const isOpen = ref(false)

const user = usePage().props.auth.user

router.on('navigate', () => {
  isOpen.value = false
})
</script>
