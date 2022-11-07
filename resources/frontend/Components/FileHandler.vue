<template>
  <div
    class="tw-w-max tw-h-max"
    @click.stop="selectFile"
    @drop.prevent="onDrop"
    @dragenter.prevent="dragging = true"
    @dragleave.prevent="onLeave"
    @dragover.prevent
  >
    <slot :dragging="dragging" />
  </div>
</template>

<script setup>
import fileDialog from 'file-dialog'

const emit = defineEmits(['selected'])

const files = ref([])

const dragging = ref(false)

const selectFile = () => {
  fileDialog({ accept: 'image/* ' })
    .then(files => {
      emit('selected', files)
    })
}

const onLeave = (event) => {
  if (event.currentTarget.contains(event.relatedTarget)) {
    return
  }

  dragging.value = false
}

const onDrop = (event) => {
  dragging.value = false

  files.value = []

  if (event.dataTransfer.items) {
    // Use DataTransferItemList interface to access the file(s)
    [...event.dataTransfer.items].forEach((item, i) => {
      // If dropped items aren't files, reject them
      if (item.kind !== 'file') {
        return
      }

      files.value.push(item.getAsFile())
    })
  } else {
    // Use DataTransfer interface to access the file(s)
    [...event.dataTransfer.files].forEach((file, i) => {
      files.value.push(file)
    })
  }

  emit('selected', files.value)
}
</script>
