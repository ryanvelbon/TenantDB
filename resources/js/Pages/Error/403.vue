<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    message: String,
})
</script>

<template>
  <main class="grid min-h-full place-items-center bg-white py-24 px-6 sm:py-32 lg:px-8">
    <div class="text-center">
      <p class="text-base font-semibold text-indigo-600">403</p>
      <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Forbidden access</h1>
      <p class="mt-6 text-base leading-7 text-gray-600">{{ message }}</p>
      <div class="mt-10 flex items-center justify-center gap-x-6">
        <Link :href="route('frontend.dashboard')" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Go back home</Link>
        <a href="#" class="text-sm font-semibold text-gray-900">Contact support <span aria-hidden="true">&rarr;</span></a>
      </div>
    </div>
  </main>
</template>