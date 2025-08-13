<template>
    <nav class="bg-white shadow px-6 py-4">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <Link href="/" class="text-xl font-bold text-indigo-600">
          Securitrack
        </Link>
  
        <!-- Hamburger Icon -->
        <button @click="open = !open" class="md:hidden focus:outline-none">
          <svg
            class="w-6 h-6 text-gray-800"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            ></path>
          </svg>
        </button>
  
        <!-- Menu (Desktop) -->
        <div class="hidden md:flex items-center space-x-4">
          <template v-if="isAuthenticated">
            <Link
              v-if="user.role === 'admin'"
              href="/admin/dashboard"
              class="nav-link"
            >
              Admin Panel
            </Link>
            <Link
              v-if="user.role === 'tecnico'"
              href="/tecnico/tickets"
              class="nav-link"
            >
              Mis Tickets
            </Link>
            <Link
              v-if="user.role === 'usuario'"
              href="/tickets"
              class="nav-link"
            >
              Mis Tickets
            </Link>
            <span class="text-sm text-gray-600">👤 {{ user.name }}</span>
            <Link
              :href="route('logout')"
              method="post"
              as="button"
              class="logout-btn"
            >
              Cerrar sesión
            </Link>
          </template>
  
          <template v-else>
            <Link href="/login" class="nav-link">Iniciar sesión</Link>
            <Link href="/register" class="nav-link">Registrarse</Link>
          </template>
        </div>
      </div>
  
      <!-- Menu (Mobile) -->
      <div v-if="open" class="mt-4 md:hidden space-y-2">
        <template v-if="isAuthenticated">
          <Link
            v-if="user.role === 'admin'"
            href="/admin/dashboard"
            class="mobile-link"
          >
            Admin Panel
          </Link>
          <Link
            v-if="user.role === 'tecnico'"
            href="/tecnico/tickets"
            class="mobile-link"
          >
            Mis Tickets
          </Link>
          <Link
            v-if="user.role === 'usuario'"
            href="/tickets"
            class="mobile-link"
          >
            Mis Tickets
          </Link>
          <span class="block text-sm text-gray-600">👤 {{ user.name }}</span>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="block text-red-600 hover:underline text-sm"
          >
            Cerrar sesión
          </Link>
        </template>
  
        <template v-else>
          <Link href="/login" class="mobile-link">Iniciar sesión</Link>
          <Link href="/register" class="mobile-link">Registrarse</Link>
        </template>
      </div>
    </nav>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { usePage, Link } from '@inertiajs/vue3'
  
  const open = ref(false)
  const page = usePage()
  const user = page.props.auth.user
  const isAuthenticated = !!user
  </script>
  
  <style scoped>
  .nav-link {
    @apply text-gray-700 hover:text-indigo-600 text-sm font-medium;
  }
  .logout-btn {
    @apply bg-red-500 text-white text-sm px-3 py-1.5 rounded hover:bg-red-600 transition;
  }
  .mobile-link {
    @apply block text-gray-700 hover:text-indigo-600 text-sm font-medium;
  }
  </style>
  