<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Roles" />

    <AdminLayout>
        <p>Role/Index page</p>
        <div>{{ data.roles }}</div>
    </AdminLayout>
</template>