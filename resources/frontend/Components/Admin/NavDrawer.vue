<template>
  <v-navigation-drawer
    v-model="drawer.isOpen"
    :rail="drawer.isRail"
    expand-on-hover
    width="240"
    color="nav-drawer-toolbar"
    theme="dark"
  >
    <v-toolbar
      color="nav-drawer-toolbar"
      density="compact"
    >
      <v-toolbar-title>
        <div class="tw-flex tw-items-center">
          <ApplicationLogo class="tw-w-6 tw-mr-4 tw-fill-white" />

          <span class="tw-font-extralight">
            Pronto Fuel
          </span>
        </div>
      </v-toolbar-title>
    </v-toolbar>
    <v-list
      nav
      density="compact"
    >
      <NavLink
        title="Dashboard"
        :icon="mdiHomeOutline"
        to="admin.dashboard"
      />
    </v-list>
  </v-navigation-drawer>
</template>

<script setup>
import { useNavDrawer } from '@/store/nav-drawer'
import { mdiHomeOutline, mdiAccountOutline } from '@mdi/js'

const drawer = useNavDrawer()
const { mobile } = useDisplay()

const hide = () => {
  if (mobile.value && drawer.isOpen) {
    drawer.toggle()
  }
}

Inertia.on('navigate', hide)
</script>
