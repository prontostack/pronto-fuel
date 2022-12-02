<template>
  <div class="tw-pt-1 tw-px-1 tw-w-48 tw-box-border">
    <Switch
      v-model="data.playerSettings.autoplay"
      label="Autoplay"
      :false-value="0"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.cc_load_policy"
      label="Force subtitles"
      :false-value="null"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.controls"
      label="Show controls"
      :false-value="0"
      :true-value="2"
    />
    <Switch
      v-model="data.playerSettings.fs"
      label="Allow fullscreen"
      :false-value="0"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.iv_load_policy"
      label="Show annotations"
      :false-value="3"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.loop"
      label="Loop video"
      :false-value="0"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.modestbranding"
      label="Hide YouTube logo"
      :false-value="null"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.rel"
      label="Show related videos at the end"
      :false-value="0"
      :true-value="1"
    />
    <Switch
      v-model="data.playerSettings.showinfo"
      label="Show video information"
      :false-value="0"
      :true-value="1"
    />
  </div>
</template>

<script setup>
import { useEmbed } from '@/Fields/RichText/Embed/embed-store'

const { data } = storeToRefs(useEmbed())
</script>

<style lang="scss" scoped>

</style>
