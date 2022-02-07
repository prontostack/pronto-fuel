import '@/assets/tailwind.css'
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
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
      .mixin({
        methods: {
          route: window.route
        }
      })
      .mount(el)
  }
})

InertiaProgress.init({ color: '#4B5563' })
