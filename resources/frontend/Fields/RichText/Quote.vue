<template>
  <contenteditable
    v-model="data.quote"
    tag="blockquote"
    class="ce-quote cdx-block"
    :no-html="false"
  />
</template>

<script setup>
import contenteditable from 'vue-contenteditable'
import { useBlockTool } from '@/Fields/RichText/BlockTool/block-tool-store'

const store = useBlockTool()

const { data } = storeToRefs(store)
</script>

<style lang="scss" scoped>
.ce-quote {
  font-size: 1.3rem;
  border-left: 2px solid #ccc;
  padding: 0 0 0 16px;
  margin: 16px 0;

  &:focus {
    outline: none ;
  }

  cite {
    font-style: italic;
  }
}
</style>
