<template>
  <v-otp-input
    v-bind="$attrs"
    ref="otpInput"
    :input-classes="[
      'otp-input',
      isInvalid
        ? 'otp-input--error'
        : ''
    ]"
    separator=""
    :num-inputs="6"
    :should-auto-focus="true"
    :is-input-num="true"
    class="tw-space-x-4"
    :class="{
      'tw-justify-center': justify === 'center'
    }"
    @on-change="emit('update:modelValue', $event)"
    @on-complete="submitOnComplete ? emit('submit-form') : null"
  />
  <div
    v-if="isInvalid"
    class="tw-flex tw-mt-2"
    :class="{
      'tw-justify-center': justify === 'center'
    }"
  >
    <span
      class="tw-text-danger-500 tw-text-sm"
      v-text="error"
    />
  </div>
</template>

<script setup>
import VOtpInput from 'vue3-otp-input'

const props = defineProps({
  modelValue: undefined,
  justify: String,
  submitOnComplete: Boolean,
  error: String
})

const emit = defineEmits([
  'update:modelValue',
  'submit-form'
])

const isInvalid = computed(() => (props.error && (typeof props.error !== 'undefined')))
</script>

<script>
export default {
  inheritAttrs: false
}
</script>

<style lang="scss">
  .tw-dark {
    .otp-input:not(.otp-input--error) {
      border: 1px solid rgba(255, 255, 255, .6);

      /* Background colour of an input field with value */
      &.is-complete {
        background-color: rgba(0, 0, 0, 0.3);
      }
    }
  }

  .otp-input {
    width: 40px;
    height: 40px;
    padding: 5px;
    /* margin: 0 10px; */
    font-size: 20px;
    border-radius: 4px;
    background: none;
    text-align: center;
    border: 1px solid rgba(0, 0, 0, 0.3);
    transition: all .3s ease-in-out;

    /* Background colour of an input field with value */
    &.is-complete {
      background-color: rgba(0, 0, 0, 0.1);
    }

    &::-webkit-inner-spin-button,
    &::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    &::placeholder {
      font-size: 15px;
      text-align: center;
      font-weight: 600;
    }

    &:focus {
      border: 1px solid rgb(var(--v-theme-primary));
      outline: 1px solid rgb(var(--v-theme-primary));
    }

    &--error {
      border: 1px solid rgb(var(--v-theme-error));
      outline: 1px solid rgb(var(--v-theme-error));
    }
  }
</style>
