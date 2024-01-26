import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import AutoImport from 'unplugin-auto-import/vite'
import Components from 'unplugin-vue-components/vite'
import Icons from 'unplugin-icons/vite'
import IconsResolver from 'unplugin-icons/resolver'
import { defineConfig } from 'vite'
import { QuasarResolver } from 'unplugin-vue-components/resolvers'
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'
import { resolve } from 'path'

export default defineConfig({
  plugins: [
    laravel({
      input: 'resources/frontend/app.js',
      ssr: 'resources/frontend/ssr.js'
    }),

    vue({
      template: { transformAssetUrls }
    }),

    quasar({
      autoImportComponentCase: 'combined',
      sassVariables: '@/assets/quasar.variables.scss'
    }),

    AutoImport({
      imports: [
        'vue',
        'pinia',
        'quasar',
        {
          '@inertiajs/vue3': [
            'router',
            'usePage',
            'useForm'
          ]
        }
      ]
    }),

    Components({
      dirs: [
        './resources/frontend/Components',
        './resources/frontend/FormInputs',
        './resources/frontend/Layouts',
        './resources/frontend/Transitions'
      ],
      extensions: [
        'vue'
      ],
      directoryAsNamespace: true,
      deep: true,
      resolvers: [
        QuasarResolver(),
        IconsResolver(),
        (name) => {
          if (name === 'Head') {
            return {
              importName: 'Head',
              path: '@inertiajs/vue3'
            }
          }

          if (name === 'Link') {
            return {
              importName: 'Link',
              path: '@inertiajs/vue3'
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
      enforce: 'pre',
      transform: (code, id) => {
        const layoutRegex = /<template +layout(?: *= *['"](?:(?:([\w|,]+):)?([\w|,]+))['"] *)?>/

        if (!layoutRegex.test(code)) {
          return code
        }

        const isTypeScript = /lang=['"]ts['"]/.test(code)

        return code.replace(layoutRegex, (_, __, layoutNames) => {
          const layoutImports = layoutNames.split(',').map((layoutName) => `import ${layoutName} from '@/Layouts/${layoutName}.vue'`)

          const newCode = `
            <script${isTypeScript ? ' lang="ts"' : ''}>
            ${layoutImports.join('\n')}
            export default {
              layout: [${layoutNames}]
            }
            </script>
            <template>
          `

          return newCode
        })
      }
    }
  ],

  // Uncomment this if you're not inside Docker
  // server: {
  //   port: 3000
  // },

  // Delete this if you're not inside docker
  // and uncomment above
  server: {
    host: '0.0.0.0',
    port: 3000,
    hmr: {
      host: 'localhost',
      port: 3000
    }
  },

  resolve: {
    alias: {
      '@': resolve(__dirname, 'resources/frontend')
    }
  }
})
