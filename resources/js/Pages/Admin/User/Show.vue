<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head :title="data.user.name" />

    <AdminLayout>
        <p class="text-2xl font-bold">{{ data.user.name }}</p>
        <div>{{ data.user }}</div>
    </AdminLayout>
</template>