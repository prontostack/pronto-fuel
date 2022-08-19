<template>
  <Link
    preserve-state
    preserve-scroll
    :only="['modal']"
  >
    <slot />
  </Link>
</template>
