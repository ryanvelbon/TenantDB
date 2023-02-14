<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  data: Object,
})

</script>

<template>
  <AppLayout>
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-xl font-semibold text-gray-900">Reports</h1>
          <p class="mt-2 text-sm text-gray-700">Here are all the reports you have filed.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
          <Link :href="route('frontend.tenantReports.create')" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Create Report</Link>
        </div>
      </div>
      <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
              <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Report ID</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">Passport</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">National ID</th>
                    <th scope="col" class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">DOB</th>
                    <th scope="col" class="relative whitespace-nowrap py-3.5 pl-3 pr-4 sm:pr-6">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="report in data.reports" :key="report.id">
                    <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm text-gray-500 sm:pl-6">{{ report.id }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm font-medium text-gray-900">{{ report.first_name }} {{ report.last_name }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-900">{{ report.email }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ report.phone }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ report.passport }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ report.id_card }}</td>
                    <td class="whitespace-nowrap px-2 py-2 text-sm text-gray-500">{{ report.dob }}</td>
                    <td class="relative whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                      <a href="#" class="text-indigo-600 hover:text-indigo-900"
                        >Edit<span class="sr-only">, {{ report.id }}</span></a
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
