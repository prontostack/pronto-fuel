<template>
  <q-drawer
    v-model="isDrawerOpen"
    show-if-above
    side="left"
    :width="width"
    :mini-width="miniWidth"
    :mini="isDrawerMini"
    :breakpoint="600"
    class="
      tw-bg-primary-50
      dark:tw-bg-slate-800
    "
  >
    <q-scroll-area class="fit">
      <div class="drawer__content">
        <q-toolbar class="drawer__toolbar tw-bg-primary-500 text-white">
          <div class="drawer__logo tw-flex tw-justify-center tw-items-center">
            <ApplicationLogo class="tw-w-9 tw-fill-white" />
          </div>
          <q-toolbar-title class="tw-flex tw-items-center">
            <span class="tw-font-extralight">Pronto Fuel</span>
          </q-toolbar-title>
        </q-toolbar>
        <slot />
      </div>
    </q-scroll-area>
  </q-drawer>
</template>

<script setup>
const $q = useQuasar()

const props = defineProps({
  width: {
    type: Number,
    default: 240
  },
  miniWidth: {
    type: Number,
    default: 60
  },
  isOpen: Boolean,
  mini: Boolean
})

const emit = defineEmits([
  'update:isOpen',
  'update:mini'
])

const isDrawerOpen = computed({
  get () {
    if ($q.screen.gt.xs) {
      return true
    }

    return props.isOpen
  },
  set (value) {
    emit('update:isOpen', value)
  }
})

const isDrawerMini = computed({
  get () {
    if ($q.screen.xs) {
      return false
    }

    return props.mini
  },
  set (value) {
    emit('update:mini', value)
  }
})

const pixelWidth = computed(() => props.width + 'px')
const pixelMiniWidth = computed(() => props.miniWidth + 'px')

provide('mini', isDrawerMini)
provide('width', props.width)
provide('miniWidth', props.miniWidth)

Inertia.on('navigate', () => {
  emit('update:isOpen', false)
})
</script>

<style lang="scss">
.drawer {
  &__toolbar {
    padding: 0;

    .q-toolbar__title {
      padding: 0;
    }
  }

  &__content {
    width: v-bind(pixelWidth);
  }

  &__logo {
    width: v-bind(pixelMiniWidth);
  }
}
</style>
