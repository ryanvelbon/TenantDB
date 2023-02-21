<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    contracts: Object,
})
</script>

<template>
  <AppLayout>
    <div>
      <Link :href="route('frontend.contracts.create')" class="bg-blue-500 hover:bg-blue-300 p-2">Create contract</Link>
    </div>
    <table class="text-xs">
      <thead>
        <tr>
          <th>Name</th>
          <th>Title</th>
          <th>Tenant</th>
          <th>Rent</th>
          <th>Deposit</th>
          <th>
            <span>Edit</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contract in contracts.data" :key="contract.id">
          <td class="px-4">{{ contract.startDate }}</td>
          <td class="px-4">{{ contract.endDate }}</td>
          <td class="px-4">{{ contract.tenant.first_name }} {{ contract.tenant.last_name }}</td>
          <td class="px-4">{{ contract.rent }} / month</td>
          <td class="px-4">{{ contract.deposit }}</td>
          <td>
            <a href="#">Edit</a>
          </td>
        </tr>
      </tbody>
    </table>
  </AppLayout>
</template>