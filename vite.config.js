import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import Icons from 'unplugin-icons/vite'
import IconsResolver from 'unplugin-icons/resolver'
const Dotenv = require('dotenv')
const { resolve } = require('path')

Dotenv.config()

const ASSET_URL = process.env.ASSET_URL || ''

export default {
  plugins: [
    AutoImport({
      imports: [
        'vue',
        {
          '@inertiajs/inertia-vue3': [
            'usePage',
            'useForm'
          ]
        }
      ]
    }),
    Components({
      dirs: [
        'Components',
        'Layouts',
        resolve(__dirname, 'resources/prontostack/pronto-ui/src/Components')
      ],
      extensions: [
        'vue'
      ],
      directoryAsNamespace: true,
      deep: true,
      resolvers: [
        IconsResolver(),
        (name) => {
          if (name === 'Head') {
            return {
              importName: 'Head',
              path: '@inertiajs/inertia-vue3'
            }
          }

          if (name === 'Link') {
            return {
              importName: 'Link',
              path: '@inertiajs/inertia-vue3'
            }
          }
        }
      ]
    }),
    Icons({
      autoInstall: true
    }),
    {
      name: 'vite:inertia:layout',
      transform: (code) => {
        if (!/<template +layout(?: *= *['"](?:(?:(\w+):)?(\w+))['"] *)?>/.test(code)) {
          return
        }

        const isTypeScript = /lang=['"]ts['"]/.test(code)

        return code.replace(/<template +layout(?: *= *['"](?:(?:(\w+):)?(\w+))['"] *)?>/, (_, __, layoutName) => `
          <script${isTypeScript ? ' lang="ts"' : ''}>
          import layout from '@/Layouts/${layoutName ?? 'Guest'}.vue'
          export default { layout }
          </script>
          <template>
        `)
      }
    },
    vue()
  ],

  root: 'resources/frontend',
  base: ASSET_URL,

  build: {
    outDir: resolve(__dirname, 'public/dist'),
    emptyOutDir: true,
    manifest: true,
    target: 'es2018',
    rollupOptions: {
      input: 'app.js'
    }
  },

  server: {
    strictPort: true,
    port: 3000
  },

  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/frontend')
    }
  },

  optimizeDeps: {
    include: [
      'vue',
      '@inertiajs/inertia',
      '@inertiajs/inertia-vue3',
      '@inertiajs/progress',
      'axios'
    ]
  }
}
