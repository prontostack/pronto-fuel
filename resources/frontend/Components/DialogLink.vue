<template>
  <Link
    preserve-state
    preserve-scroll
    :only="['modal']"
    class="tw-no-underline"
  >
    <slot />
  </Link>
</template>
