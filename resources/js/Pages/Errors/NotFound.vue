<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
      <h1 class="text-6xl font-bold text-gray-700">404</h1>
      <p class="text-gray-500 text-xl mt-4">Página no encontrada</p>
  
      <Link
        :href="redirectHome"
        class="mt-6 text-white bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded"
      >
        Volver al inicio
      </Link>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue'
  import { usePage, Link } from '@inertiajs/vue3'
  
  const page = usePage()
  
  const redirectHome = computed(() => {
    const user = page.props?.auth?.user
  
    if (!user) return '/'
    if (user.role === 'admin') return '/admin/dashboard'
    if (user.role === 'tecnico') return '/tecnico/tickets'
    return '/tickets'
  })
  </script>
  