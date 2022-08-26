<template>
  <q-layout view="lhr lpr lfr">
    <q-header>
      <q-toolbar class="tw-bg-primary-800">
        <q-btn
          dense
          flat
          round
          @click="
            ($q.screen.xs)
              ? isNavDrawerOpen = !isNavDrawerOpen
              : layout.navigationDrawer.mini = !layout.navigationDrawer.mini
          "
        >
          <i-mdi-menu class="tw-text-lg" />
        </q-btn>
        <q-toolbar-title class="tw-flex tw-items-center">
          <span class="tw-font-extralight">{{ $page.props.title }}</span>
        </q-toolbar-title>
        <q-space class="tw-hidden sm:tw-flex" />
        <AccountMenu />
      </q-toolbar>
    </q-header>

    <NavDrawer
      v-model:is-open="isNavDrawerOpen"
      v-model:mini="layout.navigationDrawer.mini"
    >
      <NavList bookmarker>
        <NavLink
          :href="route('dashboard')"
          :active="route().current('dashboard')"
        >
          <template #icon>
            <i-mdi-home-outline />
          </template>
          Dashboard
        </NavLink>
        <NavLink
          :href="route('account.index')"
          :active="route().current('account.index')"
        >
          <template #icon>
            <i-mdi-account-outline />
          </template>
          Account
        </NavLink>
      </NavList>
    </NavDrawer>

    <q-page-container>
      <FadeTransition>
        <slot />
      </FadeTransition>
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { useLocalStorage } from '@vueuse/core'

const $q = useQuasar()

const page = usePage()

const isNavDrawerOpen = ref($q.screen.gt.xs)

const layout = useLocalStorage(`authenticated-layout-${page.props.value.auth.user.id}`, {
  navigationDrawer: {
    mini: true
  }
})
</script>
