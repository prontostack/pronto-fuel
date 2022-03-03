import '@/assets/tailwind.css'

import 'quasar/dist/quasar.css'
/**
 * Uncomment this and remove the line above if you want
 * to customize Quasar variables
 * @see https://quasar.dev/style/sass-scss-variables
 *
 * import 'quasar/src/css/index.sass'
 */

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { Quasar } from 'quasar'
import quasarIconSet from 'quasar/icon-set/svg-mdi-v6'
import axios from 'axios'
import Notifications from '@kyvg/vue3-notification'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

const pages = import.meta.glob('./Pages/**/*.vue')

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) => {
    const importPage = pages[`./Pages/${name}.vue`]

    if (!importPage) {
      throw new Error(`Unknown page ${name}. Is it located under Pages with a .vue extension?`)
    }

    return typeof importPage === 'function'
      ? importPage()
      : importPage
  },
  setup ({ el, app, props, plugin }) {
    return createApp({ render: () => h(app, props) })
      .use(plugin)
      .use(Notifications)
      .use(Quasar, {
        iconSet: quasarIconSet
      })
      .mixin({
        methods: {
          route: window.route
        }
      })
      .mount(el)
  }
})
