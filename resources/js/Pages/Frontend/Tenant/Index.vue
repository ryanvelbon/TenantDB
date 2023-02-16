<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
  tenants: Object
})
</script>

<template>

  <Head title="Tenants" />

  <AppLayout>
    <div class="px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Tenants</h1>
          <p class="mt-2 text-sm text-gray-700">A list of all your tenants.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <button type="button" class="block rounded-md bg-indigo-600 py-1.5 px-3 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add tenant</button>
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="-my-2 -mx-6 overflow-x-auto lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-6 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-3">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Passport</th>
                  <th scope="col" class="relative py-3.5 pl-3 pr-6 sm:pr-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white">
                <tr v-for="(tenant, tenantIdx) in tenants.data" :key="tenant.id" :class="tenantIdx % 2 === 0 ? undefined : 'bg-gray-50'">
                  <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 sm:pl-3">{{ tenant.firstName }} {{ tenant.lastName }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ tenant.phone }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ tenant.email }}</td>
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ tenant.passport }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium sm:pr-3">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900"
                      >Edit<span class="sr-only">, {{ tenant.firstName }}</span></a
                    >
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div>
          <Pagination class="mt-6" :links="tenants.links" />
      </div>
    </div>
  </AppLayout>
</template>