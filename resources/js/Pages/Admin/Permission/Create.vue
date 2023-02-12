<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Create a new Permission" />

    <AdminLayout>
        <p>Permission/Create page</p>
    </AdminLayout>
</template>