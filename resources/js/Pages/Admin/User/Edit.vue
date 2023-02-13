<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
})
</script>

<template>

    <Head title="Edit User" />

    <AdminLayout>
        <p>User/Edit page</p>
        <p>You are editing User {{ data.user.id }}</p>
        <p>Choose from the following roles:</p>
        <div>{{ data.roles }}</div>
    </AdminLayout>
</template>