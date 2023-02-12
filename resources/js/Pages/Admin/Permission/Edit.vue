<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Head } from '@inertiajs/vue3'
const props = defineProps({
    data: Object,
    meta: Object
})
</script>

<template>

    <Head title="Edit Permission" />

    <AdminLayout>
        <p>Permission/Edit page</p>
    </AdminLayout>
</template>