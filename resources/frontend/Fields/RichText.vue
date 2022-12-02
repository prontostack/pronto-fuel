<template>
  <div>
    <div :id="id" />
  </div>
</template>

<script setup>
import { v4 as uuid } from 'uuid'
import EditorJS from '@editorjs/editorjs'
import Ad from '@/Fields/RichText/Ad'
import AlignmentTune from 'editorjs-text-alignment-blocktune'
import ChangeCase from 'editorjs-change-case'
import Checklist from '@editorjs/checklist'
import Cite from './RichText/Cite'
import Delimiter from '@editorjs/delimiter'
import Embed from './RichText/Embed/Embed'
import FootNotesTune from '@editorjs/footnotes'
import Header from '@editorjs/header'
import Hyperlink from 'editorjs-hyperlink'
import InlineCode from '@editorjs/inline-code'
import List from '@editorjs/nested-list'
import Marker from '@editorjs/marker'
import Quote from '@/Fields/RichText/Quote'
import Table from '@editorjs/table'
import Underline from '@editorjs/underline'
import Undo from 'editorjs-undo'

const id = `editor-${uuid()}`

const props = defineProps({
  modelValue: Object
})

const emit = defineEmits(['update:modelValue'])

const editor = new EditorJS({
  holder: id,
  data: props.modelValue,
  placeholder: 'What do you have to say?',
  tools: {
    // post: Post
    // social: Social
    // snippet: Snippet
    // code: Code
    // embed: Embed,
    // Attaches
    // Link Auto Complete
    ad: Ad,
    alignmentTune: AlignmentTune,
    changeCase: ChangeCase,
    checklist: {
      class: Checklist,
      inlineToolbar: true,
      tunes: ['footNotesTune', 'alignmentTune']
    },
    cite: {
      class: Cite,
      shortcut: 'CTRL+SHIFT+C'
    },
    delimiter: Delimiter,
    embed: Embed,
    footNotesTune: {
      class: FootNotesTune,
      inlineToolbar: true
    },
    header: {
      class: Header,
      inlineToolbar: true,
      tunes: ['footNotesTune', 'alignmentTune'],
      config: {
        levels: [2, 3, 4],
        defaultLevel: 2
      }
    },
    hyperlink: Hyperlink,
    inlineCode: {
      class: InlineCode,
      shortcut: 'CTRL+SHIFT+I'
    },
    Marker: {
      class: Marker,
      shortcut: 'CTRL+SHIFT+M'
    },
    list: {
      class: List,
      inlineToolbar: true,
      tunes: ['footNotesTune', 'alignmentTune']
    },
    paragraph: {
      tunes: ['footNotesTune', 'alignmentTune']
    },
    quote: {
      class: Quote,
      inlineToolbar: true,
      tunes: ['footNotesTune'],
      shortcut: 'CTRL+SHIFT+Q'
    },
    table: {
      class: Table,
      inlineToolbar: true
    },
    underline: {
      class: Underline,
      shortcut: 'CTRL+SHIFT+U'
    }
  },
  onReady: () => {
    const undo = new Undo({ editor })

    undo.initialize(props.modelValue)
  },
  onChange: (api, event) => {
    editor.save().then((outputData) => {
      emit('update:modelValue', outputData)
    }).catch((error) => {
      console.log('Saving failed: ', error)
    })
  }
})
</script>

<style lang="scss">
.ce-settings__default-zone:not(:empty) {
  background: #f5f5f5;
}

.ce-settings__plugin-zone:not(:empty) {
  padding: 3px;
}
</style>
