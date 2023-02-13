<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
})
</script>

<template>

    <Head title="Create a User" />

    <AdminLayout>
        <p>User/Create page</p>
        <p>Create a user and assign roles. User can have the following roles:</p>
        <div>{{ data.roles }}</div>
    </AdminLayout>
</template>