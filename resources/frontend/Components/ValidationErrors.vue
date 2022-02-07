<template>
  <div v-if="hasErrors">
    <div class="font-medium text-danger-600">
      Whoops! Something went wrong.
    </div>

    <ul class="mt-3 list-disc list-inside text-sm text-danger-600">
      <li
        v-for="(error, key) in errors"
        :key="key"
      >
        {{ error }}
      </li>
    </ul>
  </div>
</template>

<script setup>
const $page = usePage()

const errors = computed(() => {
  return $page.props.value.errors
})

const hasErrors = computed(() => {
  return Object.keys(errors).length > 0
})
</script>
