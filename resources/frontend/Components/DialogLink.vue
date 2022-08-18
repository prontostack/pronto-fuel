<template>
  <Link
    :only="['modal']"
    :preserve-state="true"
    :preserve-scroll="true"
  >
    <slot />
  </Link>
</template>
