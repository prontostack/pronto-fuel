<template>
  <div
    class="
      tw-flex
      tw-flex-col
      tw-min-h-screen
      tw-justify-center
      tw-items-center
      tw-p-6
      tw-bg-gray-100
    "
  >
    <div>
      <Link href="/">
        <ApplicationLogo class="tw-w-20 tw-h-20 tw-fill-current tw-text-gray-500" />
      </Link>
    </div>
    <div
      class="
        tw-w-full
        tw-max-w-md
        tw-mt-6
        tw-p-6
        tw-bg-white
        tw-shadow-xl
        tw-overflow-hidden
        tw-rounded-lg
      "
    >
      <slot />
    </div>
    <Toasts />
  </div>
</template>
