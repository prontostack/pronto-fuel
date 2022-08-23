<template>
  <span
    class="
      bookmarker
      tw-block
      tw-h-full
      tw-absolute
      tw-left-2
      tw-rounded-l-md
      tw-bg-white
      dark:tw-bg-slate-900
      tw-transition-all
      -tw-z-10
      before:tw-contents-['']
      before:tw-absolute
      before:tw-bg-transparent
      before:tw-box-border
      before:tw-w-[1.5rem]
      before:tw-h-[0.75rem]
      before:tw-right-0
      before:tw-bottom-full
      before:tw-rounded-br-lg
      before:tw-transition-all
      after:tw-contents-['']
      after:tw-absolute
      after:tw-bg-transparent
      after:tw-box-border
      after:tw-w-[1.5rem]
      after:tw-h-[0.75rem]
      after:tw-right-0
      after:tw-top-full
      after:tw-rounded-tr-lg
      after:tw-transition-all
    "
    :class="{
      'before:tw-block after:tw-block': $q.screen.gt.xs,
      'tw-right-2 before:tw-hidden after:tw-hidden tw-rounded-r-md': $q.screen.xs
    }"
    :data-rounded-r-inverted="$q.screen.gt.xs"
  />
</template>

<script setup>
const $q = useQuasar()

const mini = inject('mini', ref(false))
const width = inject('width', 0)
const miniWidth = inject('miniWidth', 0)

const right = computed(() => {
  if (!mini.value) {
    return '0'
  }

  return (width - miniWidth) + 'px'
})

const color = computed(() => {
  return ($q.dark.isActive)
    ? 'var(--q-dark-page)'
    : 'white'
})
</script>

<style lang="scss" scoped>
.bookmarker {
  filter: drop-shadow(0px 4px 3px rgba(0, 0, 0, .1));

  &[data-rounded-r-inverted="true"] {
    right: v-bind(right);
  }

  &:before {
    box-shadow: 0 0.4rem 0 0 v-bind(color);
  }

  &:after {
    box-shadow: 0 -0.4rem 0 0 v-bind(color);
  }
}
</style>
