import { useStorage } from '@vueuse/core'

export const useNavDrawer = defineStore('nav-drawer', () => {
  const state = useStorage('nav-drawer', {
    isOpenOnMobile: false,
    isOpenOnDesktop: false
  })

  const { mobile } = useDisplay()

  const isOpen = computed({
    get () {
      return mobile.value
        ? state.value.isOpenOnMobile
        : true
    },
    set (val) {
      if (mobile.value) {
        state.value.isOpenOnMobile = val
      }
    }
  })

  const isRail = computed(() => {
    return mobile.value
      ? false
      : !state.value.isOpenOnDesktop
  })

  function toggle () {
    mobile.value
      ? state.value.isOpenOnMobile = !state.value.isOpenOnMobile
      : state.value.isOpenOnDesktop = !state.value.isOpenOnDesktop
  }

  return {
    isOpen,
    isRail,
    toggle
  }
})
