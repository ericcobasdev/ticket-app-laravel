<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md bg-white p-8 rounded shadow-md space-y-6">
        <div class="flex flex-col items-center">
          <img class="h-12 w-auto mb-2" src="/images/securitrack-logo.png" alt="SecuriTrack Logo" />
          <h2 class="text-2xl font-bold text-gray-900 text-center">¿Olvidaste tu contraseña?</h2>
          <p class="text-sm text-gray-500 text-center">Te enviaremos un enlace para restablecerla.</p>
        </div>
  
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input v-model="form.email" id="email" type="email" class="input" required autofocus />
            <InputError :message="form.errors.email" />
          </div>
  
          <div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
              Enviar enlace de recuperación
            </button>
          </div>
  
          <div v-if="status" class="text-sm text-green-600 text-center">
            {{ status }}
          </div>
  
          <div class="text-sm text-center">
            <Link href="/login" class="text-indigo-600 hover:text-indigo-500">Volver al inicio de sesión</Link>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useForm, usePage, Link } from '@inertiajs/vue3'
  import InputError from '@/Components/InputError.vue'
  import { ref } from 'vue'
  
  const page = usePage()
  const status = ref(page.props.status)
  
  const form = useForm({
    email: ''
  })
  
  const submit = () => {
    form.post(route('password.email'))
  }
  </script>
  
  <style scoped>
  .input {
    width: 100%;
    padding: 0.5rem 0.75rem;
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    outline: none;
    transition: border-color 0.3s;
  }
  .input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 1px #6366f1;
  }
  </style>
  