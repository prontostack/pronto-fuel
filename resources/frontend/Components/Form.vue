<template>
  <form
    :action="action"
    :method="method"
    @submit.prevent="submit"
  >
    <div
      v-for="field in fields"
      :key="`field-${field.model}`"
    >
      <component
        :is="field.component"
        v-model="field.value"
        v-bind="field.binds"
      />
    </div>
  </form>
</template>

<script>
export default {
  components: {
    QInput: defineAsyncComponent(() => import('quasar/src/components/input/QInput'))
  }
}
</script>

<script setup>
defineProps({
  action: String,
  method: String,
  fields: Array
})

const submit = () => {

}
</script>
