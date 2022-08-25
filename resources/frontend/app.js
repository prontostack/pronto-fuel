import '@/assets/tailwind.css'
import '@quasar/extras/mdi-v6/mdi-v6.css'
import 'quasar/src/css/index.sass'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { createPinia } from 'pinia'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { i18nVue } from 'laravel-vue-i18n'
import { Quasar } from 'quasar'
import { modal } from 'momentum-modal'
import quasarIconSet from 'quasar/icon-set/svg-mdi-v6'
import axios from 'axios'
import Notifications from '@kyvg/vue3-notification'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup ({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(createPinia())
      .use(i18nVue, {
        resolve: async lang => {
          const langs = import.meta.glob('../../lang/*.json')
          return await langs[`../../lang/${lang}.json`]()
        }
      })
      .use(Notifications)
      .use(Quasar, {
        iconSet: quasarIconSet
      })
      .use(modal, {
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
      })
      .use(plugin)
      .mixin({
        methods: {
          route: window.route
        }
      })
      .mount(el)
  }
})
