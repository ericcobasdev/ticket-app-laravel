<template>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="w-full max-w-md space-y-8 bg-white p-8 rounded shadow-md">
        <div class="flex flex-col items-center">
          <img class="h-12 w-auto mb-2" src="/images/securitrack-logo.png" alt="SecuriTrack Logo" />
          <h2 class="text-center text-2xl font-bold text-gray-900">Crea tu cuenta</h2>
          <p class="text-sm text-gray-500">¡Únete al sistema de gestión de tickets!</p>
        </div>
        <form @submit.prevent="submit" class="mt-8 space-y-6">
          <div class="space-y-4">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
              <input v-model="form.name" id="name" name="name" type="text" required autofocus class="input" />
              <InputError :message="form.errors.name" />
            </div>
  
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
              <input v-model="form.email" id="email" name="email" type="email" required class="input" />
              <InputError :message="form.errors.email" />
            </div>
  
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
              <input v-model="form.password" id="password" name="password" type="password" required class="input" />
              <InputError :message="form.errors.password" />
            </div>
  
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
              <input v-model="form.password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required class="input" />
              <InputError :message="form.errors.password_confirmation" />
            </div>
          </div>
  
          <div class="flex items-center justify-between text-sm">
            <Link href="/login" class="text-indigo-600 hover:text-indigo-500">¿Ya tienes cuenta? Inicia sesión</Link>
          </div>
  
          <div>
            <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700">Registrarse</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  import InputError from '@/Components/InputError.vue'
  import { Link } from '@inertiajs/vue3'
  
  const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  })
  
  const submit = () => {
    form.post(route('register'))
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
  