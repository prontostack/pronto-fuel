<template>
  <div>
    <component
      :is="status.component"
      v-bind="status.binds"
    />
  </div>
</template>

<script>
import AccountTwoFactorDisabled from '@/Components/Account/TwoFactor/Disabled.vue'
import AccountTwoFactorUnconfirmed from '@/Components/Account/TwoFactor/Unconfirmed.vue'
import AccountTwoFactorEnabled from '@/Components/Account/TwoFactor/Enabled.vue'

export default {
  components: {
    AccountTwoFactorDisabled,
    AccountTwoFactorUnconfirmed,
    AccountTwoFactorEnabled
  }
}
</script>

<script setup>
defineProps({
  status: Object,
  trans: Object
})
</script>
