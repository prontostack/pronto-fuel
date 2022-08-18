<template>
  <Link
    :preserve-state="true"
    :preserve-scroll="true"
    :only="['modal']"
  >
    <slot />
  </Link>
</template>
