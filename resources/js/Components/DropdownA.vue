<script setup>

defineProps({
  modelValue: String,
  items: Array,
})

defineEmits(['update:modelValue']);

</script>

<template>
  <select @change="$emit('update:modelValue', $event.target.value)">
    <option disabled value="">Please select one</option>
    <option v-for="item in items" :value="item.value">
      {{ item.label }}
    </option>
  </select>
</template>