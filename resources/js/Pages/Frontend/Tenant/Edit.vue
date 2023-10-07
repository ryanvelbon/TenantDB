<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import InputError from '@/Components/InputError.vue'
import TextInput from '@/Components/TextInput.vue'

const props = defineProps({
  tenant: Object,
  countries: Object,
})

const form = useForm({
  firstName: props.tenant.firstName,
  lastName: props.tenant.lastName,
  email: props.tenant.email,
  phone: props.tenant.phone,
  nationality: props.tenant.nationality,
  passport: props.tenant.passport,
  idCard: props.tenant.idCard,
  dob: props.tenant.dob,
  deletedAt: props.tenant.deletedAt,
})


const submit = () => {
  console.log(props.tenant.id)
}

const update = () => {
  form.patch(route('frontend.tenants.update', props.tenant.id), {
    onFinish: () => console.log("Success. Record has been updated."),
  })
}

const destroy = () => {
  if (confirm('Are you sure you want to delete this tenant?')) {
    form.delete(route('frontend.tenants.destroy', props.tenant.id), {
      onFinish: () => console.log("Success. Record has been deleted."),
    })
  }
}

const restore = () => {

}

</script>

<template>
  <AppLayout>
    <div>
      <button @click="destroy" class="bg-red-500 text-white px-4 py-2">Delete</button>
    </div>
    <form @submit.prevent="update">
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
        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Save Changes</button>
      </div>
    </form>
  </AppLayout>
</template>
