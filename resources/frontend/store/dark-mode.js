import { useStorage } from '@vueuse/core'

export const useDarkMode = defineStore('dark-mode', () => {
  const enabled = useStorage('dark-mode', (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches))

  const setDarkMode = () => {
    const body = document.querySelector('body');

    (enabled.value)
      ? body.classList.add('tw-dark')
      : body.classList.remove('tw-dark')
  }

  function toggle () {
    enabled.value = !enabled.value
    setDarkMode()
  }

  return {
    enabled,
    setDarkMode,
    toggle
  }
})
