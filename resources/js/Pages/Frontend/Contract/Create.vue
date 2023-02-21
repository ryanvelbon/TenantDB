<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
    tenants: Object,
    properties: Object,
})

const form = useForm({
    startDate: '',
    endDate: '',
    rent: '',
    deposit: '',
    tenant: '',
    property: '',
})

const submit = () => {
    form.post(route('frontend.contracts.store'), {
        // onFinish: () => form.reset(),
    })
}
</script>

<template>
    <AppLayout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <Head title="Create a Contract" />

                <h2 class="font-bold text-2xl">Create a Contract</h2>

                <form @submit.prevent="submit">

                    <div class="mt-4">
                        <InputLabel for="tenant" value="Tenant" />
                        <select id="tenant" name="tenant" v-model="form.tenant">
                            <option v-for="tenant in tenants" :value="tenant.id">{{ tenant.first_name }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.tenant" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="property" value="Property" />
                        <select id="property" name="property" v-model="form.property">
                            <option v-for="property in properties" :value="property.id">{{ property.address }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.property" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="rent" value="Rent" />
                        <input id="rent" name="rent" type="number" min="" max="" v-model="form.rent">
                        <InputError class="mt-2" :message="form.errors.rent" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="deposit" value="Deposit" />
                        <input id="deposit" name="deposit" type="number" min="" max="" v-model="form.deposit">
                        <InputError class="mt-2" :message="form.errors.deposit" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="startDate" value="Start Date" />
                        <TextInput
                            id="startDate"
                            type="date"
                            v-model="form.startDate"
                            class="mt-1 block"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.startDate" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="endDate" value="End Date" />
                        <TextInput
                            id="endDate"
                            type="date"
                            v-model="form.endDate"
                            class="mt-1 block"
                            required
                        />
                        <InputError class="mt-2" :message="form.errors.endDate" />
                    </div>

                    <div class="mt-4">
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Submit
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>