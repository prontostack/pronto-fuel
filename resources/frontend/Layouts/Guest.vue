<template>
  <div
    class="
      flex
      flex-col
      min-h-screen
      justify-center
      items-center
      p-6
      bg-gray-100
    "
  >
    <div>
      <Link href="/">
        <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
      </Link>
    </div>
    <div
      class="
        w-full
        max-w-md
        mt-6
        p-6
        bg-white
        shadow-xl
        overflow-hidden
        rounded-lg
      "
    >
      <slot />
    </div>
    <Toasts />
  </div>
</template>
