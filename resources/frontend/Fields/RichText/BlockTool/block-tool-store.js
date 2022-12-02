export const useBlockTool = defineStore('block-tool', () => {
  const id = ref(null)
  const type = ref(null)
  const data = ref({
    quote: ''
  })

  function init ({ id: blockId, type: blockType, data: blockData }) {
    id.value = blockId
    type.value = blockType

    Object.assign(data.value, blockData)
  }

  function setQuote (quote) {
    console.log('set quote: ', data.value)
    data.value.quote = quote
  }

  return {
    id,
    type,
    data,
    init,
    setQuote
  }
})
