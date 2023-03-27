<script setup>
import { TrashIcon } from '@heroicons/vue/20/solid'

defineEmits(['restore'])

</script>

<template>
  <div class="flex items-center justify-between p-4 max-w-3xl bg-yellow-400 rounded">
    <div class="flex items-center">
      <component :is="TrashIcon" class="mr-4 h-4 w-4 flex-shrink-0 fill-yellow-800" aria-hidden="true" />
      <div class="text-yellow-800 text-sm font-medium">
        <slot />
      </div>
    </div>
    <button class="text-yellow-800 hover:underline text-sm" tabindex="-1" type="button" @click="$emit('restore')">Restore</button>
  </div>
</template>
