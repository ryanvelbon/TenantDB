<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, useForm } from '@inertiajs/vue3'
const props = defineProps({
    meta: Object,
})
const form = useForm({
    address: '',
    type: '',
    size: 0,
    n_bedrooms: 0,
    n_bathrooms: 0,
})
const submit = () => {
    form.post(route('frontend.properties.store'), {
        // onFinish: () => form.reset(),
    })
}
</script>

<template>
    <AppLayout>
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <Head title="Create a Property" />

                <h2 class="font-bold text-2xl">Create a Property</h2>

                <form @submit.prevent="submit">

                    <div class="mt-4">
                        <InputLabel for="type" value="Property type" />
                        <select id="type" name="type" v-model="form.type">
                            <option v-for="item in meta.type" :value="item.value">{{ item.label }}</option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.type" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="size" value="Size (in m^2)" />
                        <input id="size" name="size" type="number" min="" max="" v-model="form.size">
                        <InputError class="mt-2" :message="form.errors.size" />
                    </div>

                    <div class="mt-4">
                        <input type="number" name="n_bedrooms" v-model="form.n_bedrooms" min="1">
                    </div>

                    <div class="mt-4">
                        <input type="number" name="n_bathrooms" v-model="form.n_bathrooms" min="1">
                    </div>

                    <div class="mt-4">
                        <InputLabel for="address" value="Address" />
                        <TextInput id="address" type="text" class="mt-1 block w-full" v-model="form.address" required />
                        <InputError class="mt-2" :message="form.errors.address" />
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