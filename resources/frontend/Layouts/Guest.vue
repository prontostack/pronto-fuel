<template>
  <div
    class="
      tw-flex
      tw-flex-col
      tw-min-h-screen
      tw-justify-center
      tw-items-center
      tw-p-6
    "
  >
    <!-- tw-bg-gray-100 -->
    <div class="tw-w-full tw-max-w-md">
      <FadeTransition>
        <slot />
      </FadeTransition>
    </div>
  </div>
</template>
