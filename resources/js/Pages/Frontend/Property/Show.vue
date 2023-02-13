<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    data: Object,
    // meta: Object,
})
</script>

<template>
    <AppLayout>
        <p>{{ data }}</p>
    </AppLayout>
</template>