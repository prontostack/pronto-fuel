<template>
  <Link
    v-bind="$attrs"
    :class="{
      'tw-text-gray-500': !active,
      'tw-text-primary-500': active
    }"
  >
    <q-item
      v-ripple
      clickable
      :active="active"
    >
      <q-item-section
        side
      >
        <slot
          name="icon"
          :class="{
            'tw-text-lg': true,
            'tw-text-gray-500': !active,
            'tw-text-primary-500': active
          }"
        />
      </q-item-section>
      <q-item-section>
        <q-item-label>
          <slot />
        </q-item-label>
      </q-item-section>
    </q-item>
  </Link>
</template>

<script setup>
defineProps({
  active: Boolean
})
</script>
