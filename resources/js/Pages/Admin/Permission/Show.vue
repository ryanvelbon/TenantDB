<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Permission" />

    <AdminLayout>
        <p>Permission/Show page</p>
        <div>{{ data.permission }}</div>
    </AdminLayout>
</template>