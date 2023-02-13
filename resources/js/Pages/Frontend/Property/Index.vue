<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    data: Object,
    // meta: Object,
})
</script>

<template>
    <AppLayout>
        <ul>
            <li v-for="property in data.properties" class="bg-pink-200 p-4 mb-4">
                {{ property }}
            </li>
        </ul>
    </AppLayout>
</template>