import { merge } from 'lodash'
import { SERVICES } from '@/Fields/RichText/Embed/Services/services'

export const useEmbed = defineStore('embed', () => {
  const id = ref(null)
  const type = ref(null)
  const service = ref(null)
  const data = ref(null)

  function init ({ id: blockId, type: blockType, data: blockData }) {
    id.value = blockId
    type.value = blockType

    setService(blockData.service)

    if (service.value?.defaults) {
      const defaults = {
        ...service.value.defaults
      }

      data.value = merge({}, defaults, blockData)

      return
    }

    data.value = blockData
  }

  function setService (serviceName) {
    if (typeof serviceName !== 'string') {
      return
    }

    service.value = {
      ...SERVICES[serviceName]
    }
  }

  const blockComponent = computed(() => {
    return service.value?.component
      ? service.value.component + 'Block'
      : null
  })

  const settingsComponent = computed(() => {
    return service.value?.component
      ? service.value.component + 'Settings'
      : null
  })

  return {
    id,
    type,
    data,
    service,
    blockComponent,
    settingsComponent,
    init
  }
})
