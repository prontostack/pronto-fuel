import { createApp } from 'vue'
import { Quasar } from 'quasar'
import { createPinia } from 'pinia'
import quasarIconSet from 'quasar/icon-set/svg-mdi-v6'
import VueObserveVisibility from 'vue-observe-visibility'
import { useBlockTool } from '@/Fields/RichText/BlockTool/block-tool-store'

export default class BlockTool {
  constructor ({ data, api, block }) {
    this.pinia = createPinia()
    this.data = data || {}
    this.api = api
    this.block = block
    this.wrapper = undefined
    this.app = undefined
    this.vm = undefined
  }

  render () {
    this.wrapper = document.createElement('div')

    this.data.rendering = true

    this.createApp(this.data)

    return this.wrapper
  }

  save () {
    delete this.store.data.rendering

    return this.store.data
  }

  createApp (props) {
    if (this.app) {
      this.app.unmount()
    }

    // eslint-disable-next-line vue/one-component-per-file
    this.app = createApp(this.blockComponent)
      .use(Quasar, {
        iconSet: quasarIconSet
      })
      .use(this.pinia)
      .use(VueObserveVisibility)

    this.store = this.useStore()

    this.store.init({
      id: this.block.id,
      type: this.block.name,
      data: props
    })

    this.vm = this.app.mount(this.wrapper)
  }

  useStore () {
    return useBlockTool()
  }

  renderSettings () {
    if (this.settingsApp) {
      this.settingsApp.unmount()
    }

    if (!this.settingsComponent) {
      return
    }

    // eslint-disable-next-line vue/one-component-per-file
    this.settingsApp = createApp(this.settingsComponent, {
      blockId: this.block.id,
      api: this.api
    })
      .use(Quasar, {
        iconSet: quasarIconSet
      })
      .use(this.pinia)

    this.settingsWrapper = document.createElement('div')

    this.settingsApp.mount(this.settingsWrapper)

    return this.settingsWrapper
  }
}
