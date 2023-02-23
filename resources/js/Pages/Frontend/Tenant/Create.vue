<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import DropdownA from '@/Components/DropdownA.vue'
import { Head, useForm } from '@inertiajs/vue3'

const props = defineProps({
  countries: Object,
})

const countries = props.countries.map(function(obj) {
  return {
    label: obj.nicename,
    value: obj.id,
  }
})

const form = useForm({
  firstName: '',
  lastName: '',
  email: '',
  phone: '',
  nationality: '',
  passport: '',
  idCard: '',
  dob: '',
})

const submit = () => {
  form.post(route('frontend.tenants.store'), {
    onFinish: () => console.log("data submitted"),
  })
}

</script>

<template>
  <AppLayout>
    <Head title="Add a tenant" />

    <form @submit.prevent="submit" autocomplete="off">
      <section class="bg-yellow-200 p-8">
        <div class="grid sm:grid-cols-2 gap-y-6">

          <div>
            <InputLabel for="firstName" value="First Name" />
            <TextInput
              id="firstName"
              type="text"
              v-model="form.firstName"
              class="mt-1 block"
              required
              autofocus
            />
            <InputError class="mt-2" :message="form.errors.firstName" />
          </div>

          <div>
            <InputLabel for="lastName" value="Last Name" />
            <TextInput
              id="lastName"
              type="text"
              v-model="form.lastName"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.lastName" />
          </div>

          <div>
            <InputLabel for="email" value="Email" />
            <TextInput
              id="email"
              type="email"
              v-model="form.email"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div>
            <InputLabel for="phone" value="Phone" />
            <TextInput
              id="phone"
              type="text"
              v-model="form.phone"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.phone" />
          </div>

          <div>
            <InputLabel for="nationality" value="Nationality" />
            <DropdownA
              id="nationality"
              :items="countries"
              v-model="form.nationality"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.nationality" />
          </div>

          <div>
            <InputLabel for="passport" value="Passport Number" />
            <TextInput
              id="passport"
              type="text"
              v-model="form.passport"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.passport" />
          </div>

          <div>
            <InputLabel for="idCard" value="National ID" />
            <TextInput
              id="idCard"
              type="text"
              v-model="form.idCard"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.idCard" />
          </div>

          <div>
            <InputLabel for="dob" value="Date of Birth" />
            <TextInput
              id="dob"
              type="date"
              v-model="form.dob"
              class="mt-1 block"
              required
            />
            <InputError class="mt-2" :message="form.errors.dob" />
          </div>

        </div>
      </section>
      <div class="bg-pink-200 flex flex-row-reverse p-4">
        <PrimaryButton type="submit" class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Save
        </PrimaryButton>
      </div>
    </form>
  </AppLayout>
</template>