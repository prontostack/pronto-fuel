import { useStorage } from '@vueuse/core'

export const useAppShell = defineStore('app-shell', () => {
  const storageKey = ref('app-shell')

  const userId = usePage().props?.value?.auth?.user?.id

  if (userId) {
    storageKey.value = `${storageKey.value}-${userId}`
  }

  const defaultSettings = {}

  const currentSettings = useStorage(storageKey.value, defaultSettings)

  return {
    settings: currentSettings
  }
})
