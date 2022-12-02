import Loader from '@/Fields/RichText/Loader.vue'

export default (imports) => {
  const components = {}

  Object.keys(imports).forEach((filePath) => {
    const componentName = filePath.replace(/^.*[\\\/]/, '').replace(/\.[^/.]+$/, '')

    components[componentName] = defineAsyncComponent({
      // the loader function
      loader: imports[filePath],

      // A component to use while the async component is loading
      loadingComponent: Loader,
      // Delay before showing the loading component. Default: 200ms.
      delay: 0

      // A component to use if the load fails
      // errorComponent: ErrorComponent,
      // The error component will be displayed if a timeout is
      // provided and exceeded. Default: Infinity.
      // timeout: 3000
    })
  })

  return components
}
