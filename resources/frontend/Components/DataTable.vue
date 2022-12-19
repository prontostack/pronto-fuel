<template>
  <v-sheet
    rounded
    elevation="1"
    class="tw-overflow-hidden"
  >
    <table class="tw-w-full tw-border-collapse">
      <thead class="tw-bg-black/5">
        <tr>
          <th
            v-for="header in headers"
            :key="header.value"
            class="tw-px-4 tw-py-3 tw-text-sm"
            :align="header.align"
          >
            {{ header.text }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="result in results.data"
          :key="result.id"
          class="tw-py-3"
        >
          <td
            v-for="header in headers"
            :key="header.value"
            :align="header.align"
            class="tw-px-4 tw-py-3"
          >
            <slot :name="`item.${header.value}`">
              <div v-if="header.value !== 'menu'">
                {{ result[header.value] }}
              </div>
              <div v-else>
                <v-menu
                  transition="slide-y-transition"
                  location="start top"
                  origin="top center"
                >
                  <template #activator="{ props }">
                    <v-btn
                      icon
                      variant="text"
                      v-bind="props"
                      size="small"
                    >
                      <v-icon
                        :icon="mdiDotsVertical"
                      />
                    </v-btn>
                  </template>

                  <v-list
                    nav
                    density="compact"
                  >
                    <NavLink
                      title="Edit"
                      :icon="mdiPencilOutline"
                      :to="result.url.edit"
                    />

                    <v-divider class="tw-mb-[3px]" />

                    <NavLink
                      title="Delete"
                      :icon="mdiDeleteOutline"
                      to="logout"
                      method="delete"
                    />
                  </v-list>
                </v-menu>
              </div>
            </slot>
          </td>
        </tr>
      </tbody>
    </table>
  </v-sheet>
</template>

<script setup>
import { mdiDotsVertical, mdiPencilOutline, mdiDeleteOutline } from '@mdi/js'

const props = defineProps({
  confirm_bulk_destroy_message: String,
  filter: Object,
  headers: Array,
  id: String,
  loading: Boolean,
  only: Array,
  results: Object,
  selected: Array,
  sort_options: Array,
  sorts: Array,
  url_to_bulk_destroy: String,
  url_to_create: String,
  url_to_index: String
})
</script>

<style lang="scss" scoped>

</style>
