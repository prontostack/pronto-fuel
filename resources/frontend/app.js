import '@/assets/tailwind.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { createPinia } from 'pinia'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { modal } from 'momentum-modal'
import axios from 'axios'
import PortalVue from 'portal-vue'
import Notifications from '@kyvg/vue3-notification'
import vuetify from '@/plugins/vuetify'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup ({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(createPinia())
      .use(Notifications)
      .use(PortalVue)
      .use(vuetify)
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
