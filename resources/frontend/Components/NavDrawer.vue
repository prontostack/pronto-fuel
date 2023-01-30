<template>
  <q-drawer
    show-if-above
    side="left"
    :model-value="isOpen"
    :width="width"
    :mini="isMini"
    :mini-width="miniWidth"
    :breakpoint="breakpoint"
    class="
      tw-bg-primary-50
      dark:tw-bg-slate-800
    "
    @update:model-value="emit('update:isOpen')"
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

const pixelWidth = computed(() => props.width + 'px')
const pixelMiniWidth = computed(() => props.miniWidth + 'px')

const isMini = computed({
  get () { return props.mini },
  set () { emit('update:mini') }
})

provide('mini', isMini)
provide('width', props.width)
provide('miniWidth', props.miniWidth)

router.on('navigate', () => {
  if (props.isOpen && $q.screen.xs) {
    emit('update:isOpen', false)
  }
})

const breakpoint = $q.screen.sizes.sm - 1
let previousWidth = window.innerWidth

window.addEventListener('resize', () => {
  if ((previousWidth < breakpoint) && (breakpoint < window.innerWidth)) {
    if (props.isOpen) {
      emit('update:isOpen', false)
    }

    setTimeout(() => emit('update:isOpen', true), 1000)
  }

  previousWidth = window.innerWidth
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
