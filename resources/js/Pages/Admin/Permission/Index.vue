<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Permissions" />

    <AdminLayout>
        <p>Permission/Index page</p>
        <div>{{ data.permissions }}</div>
    </AdminLayout>
</template>