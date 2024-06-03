<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});
</script>

<template>
  <Head title="Welcome" />

  <div class="">
    <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
      <Link
        v-if="$page.props.auth.user"
        :href="route('frontend.dashboard')"
        class="text-sm text-gray-700 dark:text-gray-500 underline"
        >Dashboard</Link
      >

      <template v-else>
        <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
          >Register</Link
        >
      </template>
    </div>

    <div class="container bg-green-200 pt-4 pb-4 px-8">
      <a href="" class="text-2xl font-bold">TenantDB</a>
    </div>

    <div class="relative bg-gray-800">
      <div class="w-full bg-cover bg-center bg-opacity-50" style="background-image: url('/path/to/hero-image.jpg')"></div>
      <div class="absolute top-0 left-0 right-0 bottom-0 bg-gray-900 bg-opacity-50"></div>
      <div class="relative container mx-auto px-4 py-16">
        <div class="md:w-3/4 lg:w-2/3">
          <h1 class="text-4xl font-bold text-white leading-tight mb-6">Streamline Your Property Management</h1>
          <p class="text-gray-400 mb-8">Effortlessly manage properties, tenants, contracts, and more with our easy-to-use SaaS solution.</p>
          <div class="flex flex-wrap">
            <Link :href="route('register')" class="bg-white text-gray-800 font-bold py-3 px-8 rounded-full mr-4 mb-4 hover:bg-gray-100">Get Started</Link>
            <a href="#" class="bg-transparent text-white font-bold py-3 px-8 rounded-full border-2 border-white hover:bg-white hover:text-gray-800 mb-4">Learn more</a>
          </div>
        </div>
      </div>
    </div>

    <div class="container bg-blue-200 pt-40 pb-40">
      section 2
    </div>

    <div class="container bg-green-200 pt-40 pb-40">
      section 3
    </div>

    <div class="container bg-blue-200 pt-40 pb-40">
      section 4
    </div>
  </div>
</template>
