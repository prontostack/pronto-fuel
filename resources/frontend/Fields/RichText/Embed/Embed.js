import BlockTool from '@/Fields/RichText/BlockTool/BlockTool'
import EmbedBlock from './EmbedBlock.vue'
import EmbedSettings from './EmbedSettings.vue'
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'
import { PATTERNS as patterns, SERVICES } from '@/Fields/RichText/Embed/Services/services'

export default class Embed extends BlockTool {
  static get pasteConfig () {
    return {
      patterns
    }
  }

  onPaste (event) {
    let { key: service, data: source } = event.detail

    const provider = SERVICES[service]

    if (provider.sanitizeInput instanceof Function) {
      source = provider.sanitizeInput(source)
    }

    this.createApp({
      service,
      source
    })
  }

  useStore () {
    return useEmbed()
  }

  get blockComponent () {
    return EmbedBlock
  }

  get settingsComponent () {
    return EmbedSettings
  }
}
