import '@/assets/tailwind.css'
import 'quasar/src/css/index.sass'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { createPinia } from 'pinia'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { Quasar } from 'quasar'
import { modal } from 'momentum-modal'
import quasarIconSet from 'quasar/icon-set/svg-mdi-v6'
import axios from 'axios'
import Notifications from '@kyvg/vue3-notification'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  progress: false,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup ({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .use(createPinia())
      .use(plugin)
      .use(Notifications)
      .use(Quasar, {
        iconSet: quasarIconSet
      })
      .use(modal, {
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
      })
      .mixin({
        methods: {
          route: window.route
        }
      })
      .mount(el)
  }
})
