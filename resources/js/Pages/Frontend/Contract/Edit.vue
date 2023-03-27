<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/vue3'
import TrashedMessage from '@/Components/TrashedMessage.vue'

const props = defineProps({
    contract: Object,
    tenants: Object,
    properties: Object,
})

const form = useForm({
    startDate: props.contract.startDate,
    endDate: props.contract.endDate,
    rent: props.contract.rent,
    deposit: props.contract.deposit,
    tenant: props.contract.tenant.id,
    property: props.contract.property.id,
})

const update = () => {
    form.put(`/contracts/${props.contract.id}`, {
        // onFinish: () => form.reset(),
    })    
}

const destroy = () => {
    if (confirm('Are you sure you want to delete this contract?')) {
        form.delete(`/contracts/${props.contract.id}`)
    }
}

const restore = () => {
    if (confirm('Are you sure you want to restore this contract?')) {
        form.put(`/contracts/${props.contract.id}/restore`)
    }
}

</script>

<template>
    <AppLayout>
        <TrashedMessage v-if="contract.deletedAt" class="mb-6" @restore="restore"> This contract has been deleted. </TrashedMessage>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <Head title="Create a Contract" />

                <h2 class="font-bold text-2xl">Edit Contract</h2>

                <form @submit.prevent="update">

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

                    <div class="flex items-center px-8 py-4 bg-gray-50 border-t border-gray-100 mt-4">
                        <PrimaryButton v-if="!contract.deletedAt" class="text-red-600 hover:underline" tabindex="-1" type="button" @click="destroy">
                            Delete
                        </PrimaryButton>
                        <PrimaryButton v-else @click="restore">
                            Restore
                        </PrimaryButton>
                        <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>