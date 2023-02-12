<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Edit Role" />

    <AdminLayout>
        <p>Role/Edit page</p>
        <div>You are editing Role {{ data.role.id }}</div>
    </AdminLayout>
</template>