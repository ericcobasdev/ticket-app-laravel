<template>
    <div class="min-h-screen flex flex-col">
      <!-- Hero Section -->
      <header class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center py-4">
          <div class="flex items-center space-x-2">
            <img src="/images/securitrack-logo.png" alt="SecuriTrack Logo" class="h-10 w-auto">
            <span class="text-xl font-bold text-gray-800">SecuriTrack</span>
          </div>
          <div>
            <Link
              href="/login"
              class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition duration-150"
            >
              Iniciar sesión
            </Link>
          </div>
        </div>
      </header>
  
      <!-- Main Content -->
      <main class="flex-grow bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid grid-cols-1 md:grid-cols-2 items-center gap-16">
          <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">
              Seguridad, control y eficiencia <br class="hidden md:inline" />
              en la gestión de incidentes.
            </h1>
            <p class="text-lg text-gray-600 mb-6">
              SecuriTrack es un sistema profesional de tickets para empresas que valoran la seguridad, la trazabilidad y la eficiencia. 
              Diseñado para departamentos de TI y soporte técnico.
            </p>
            <Link
              href="/register"
              class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold shadow hover:bg-indigo-700 transition"
            >
              Comenzar ahora
            </Link>
          </div>
          <div class="flex justify-center">
            <img src="/images/security-dashboard.png" alt="Dashboard ilustración" class="w-full max-w-md">
          </div>
        </div>
      </main>
  
      <!-- Footer -->
      <footer class="bg-white shadow-inner py-4 text-center text-sm text-gray-500">
        © 2025 SecuriTrack. Todos los derechos reservados.
      </footer>
    </div>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3'
  </script>
  