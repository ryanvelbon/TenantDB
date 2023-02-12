<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Role" />

    <AdminLayout>
        <p>Role/Show page</p>
        <div>{{ data.role }}</div>
    </AdminLayout>
</template>