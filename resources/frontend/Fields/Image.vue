<template>
  <div class="tw-inline-block">
    <FileHandler
      v-slot="{ dragging }"
      @selected="selected"
    >
      <div
        class="
        image-upload
        tw-flex
        tw-justify-center
        tw-items-center
        tw-border
        tw-rounded
        tw-p-2
        tw-border-black/20
        hover:tw-border-black/50
        dark:tw-border-white/50
        dark:hover:tw-border-white/80
        hover:tw-cursor-pointer
        tw-transition
        tw-duration-200
        tw-group
      "
        :class="{
          'tw-border-dashed tw-border-2': dragging
        }"
      >
        <img
          v-if="currentPreview"
          :src="currentPreview"
          class="tw-rounded tw-w-full tw-h-full tw-object-cover"
        >
        <div v-else>
          <i-fa6-regular-image
            class="
            tw-text-2xl
            tw-text-black/20
            group-hover:tw-text-black/50
            dark:tw-text-white/50
            dark:group-hover:tw-text-white/80
            tw-transition
            tw-duration-200
          "
          />
        </div>
      </div>
      <Dialog
        v-if="cropperSettings"
        v-model="cropping"
      >
        <q-card>
          <q-card-section>
            <div class="tw-rounded tw-overflow-hidden">
              <Cropper
                ref="cropper"
                class="cropper"
                :src="uploadedImage"
                :stencil-props="cropperSettings.stencilProps"
              />
            </div>
          </q-card-section>
          <q-card-actions>
            <Btn
              label="Save"
              color="primary"
              @click.stop="crop"
            />
          </q-card-actions>
        </q-card>
      </Dialog>
    </FileHandler>
    <div
      v-if="currentPreview"
      class="tw-flex tw-justify-end"
    >
      <Btn
        size="xs"
        @click="() => {
          emit('update:modelValue', 'remove')
        }"
      >
        <i-mdi-delete class="tw-mr-1 tw-text-[8px]" />
        Remove
      </Btn>
    </div>
  </div>
</template>

<script setup>
import { Cropper } from 'vue-advanced-cropper'

const props = defineProps({
  width: {
    type: String,
    default: '100%'
  },
  height: {
    type: String,
    default: 'auto'
  },
  cropperSettings: Object,
  modelValue: undefined,
  preview: String
})

const emit = defineEmits(['update:modelValue'])

const uploadedImage = ref(null)
const filePreview = ref(null)
const cropping = ref(false)
const cropper = ref(null)

const currentPreview = computed(() => {
  if (props.modelValue === 'remove') {
    return null
  }

  return filePreview.value || props.preview || null
})

const selected = (files) => {
  const file = files[0]

  if (!file) {
    return
  }

  uploadedImage.value = URL.createObjectURL(file)

  if (props.cropperSettings) {
    cropping.value = true
    return
  }

  filePreview.value = uploadedImage.value

  emit('update:modelValue', file)
}

const crop = () => {
  const { canvas } = cropper.value.getResult()

  canvas.toBlob(blob => {
    filePreview.value = URL.createObjectURL(blob)

    emit('update:modelValue', blob)

    cropping.value = false
  })
}
</script>

<style lang="scss">
@import 'vue-advanced-cropper/dist/style.css';

.image-upload {
  width: v-bind(width);
  height: v-bind(height);
}

.cropper {
  max-height: calc(100vh - 300px);
}
</style>
