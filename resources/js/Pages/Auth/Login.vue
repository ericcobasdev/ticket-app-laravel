<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md bg-white p-8 rounded shadow-md space-y-6">
        <div class="flex flex-col items-center">
          <img class="h-12 w-auto mb-2" src="/images/securitrack-logo.png" alt="SecuriTrack Logo" />
          <h2 class="text-2xl font-bold text-gray-900 text-center">Iniciar sesión</h2>
          <p class="text-sm text-gray-500 text-center">Accede a tu cuenta</p>
        </div>
  
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
            <input v-model="form.email" id="email" type="email" class="input" required autofocus />
            <InputError :message="form.errors.email" />
          </div>
  
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input v-model="form.password" id="password" type="password" class="input" required autocomplete="current-password" />
            <InputError :message="form.errors.password" />
          </div>
  
          <div class="flex items-center justify-between">
            <label class="flex items-center text-sm text-gray-600">
              <input v-model="form.remember" type="checkbox" class="mr-1">
              Recuérdame
            </label>
  
            <Link :href="route('password.request')" class="text-sm text-indigo-600 hover:text-indigo-500">
              ¿Olvidaste tu contraseña?
            </Link>
          </div>
  
          <div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">
              Iniciar sesión
            </button>
          </div>
  
          <div class="text-sm text-center">
            ¿No tienes cuenta?
            <Link href="/register" class="text-indigo-600 hover:text-indigo-500">Registrarse</Link>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useForm, Link } from '@inertiajs/vue3'
  import InputError from '@/Components/InputError.vue'
  
  const form = useForm({
    email: '',
    password: '',
    remember: false,
  })
  
  const submit = () => {
    form.post(route('login'), {
      onFinish: () => form.reset('password'),
    })
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
  