<template>
  <li
    class="tw-relative tw-px-[10px]"
    :class="{
      'tw-z-10': active
    }"
  >
    <ScaleYTransition v-if="bookmarker">
      <NavLinkBookmarker v-if="active" />
    </ScaleYTransition>
    <Link
      v-bind="$attrs"
      class="
        tw-relative
        tw-flex
        tw-w-full
        tw-items-center
        tw-space-x-[10px]
        tw-group
        tw-rounded-md
        tw-transition
      "
      :class="{
        'tw-text-primary-500 dark:tw-text-primary-400': !active,
        'tw-text-accent-700 hover:tw-text-accent-700 focus:tw-text-accent-700 dark:tw-text-accent-500 dark:hover:tw-text-accent-500 dark:focus:tw-text-accent-500 hover:tw-cursor-default': active,
        'hover:tw-bg-primary-100 dark:hover:tw-bg-slate-700': !mini && !active
      }"
    >
      <span
        v-if="!!slots.icon"
        class="
          tw-relative
          tw-flex
          tw-w-[40px]
          tw-h-[40px]
          tw-justify-center
          tw-items-center
          tw-rounded-md
          tw-text-lg
          tw-transition
        "
        :class="{
          'group-hover:tw-bg-primary-100 dark:group-hover:tw-bg-slate-700': mini && !active
        }"
      >
        <slot name="icon" />
        <q-tooltip
          v-if="mini"
          anchor="center right"
          self="center left"
          transition-show="jump-right"
          transition-hide="jump-right"
        >
          <slot />
        </q-tooltip>
      </span>
      <span
        class="
          tw-flex
          tw-h-[40px]
          tw-items-center
        "
        :class="{
          'tw-px-[10px]': !slots.icon
        }"
      >
        <slot />
      </span>
    </Link>
  </li>
</template>

<script setup>
defineProps({
  active: Boolean
})

const slots = useSlots()

const mini = inject('mini', ref(false))
const bookmarker = inject('bookmarker', false)
</script>
