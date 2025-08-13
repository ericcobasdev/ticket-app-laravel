<template>
  <AppLayout title="Crear Ticket">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow rounded">
      <h1 class="text-2xl font-semibold mb-6 text-gray-800">Crear nuevo ticket</h1>

      <form @submit.prevent="submit">
        <!-- Título -->
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
          <input
            v-model="form.title"
            id="title"
            type="text"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Ej: Problema con red WiFi"
          />
          <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
          <textarea
            v-model="form.description"
            id="description"
            rows="4"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Describe el problema en detalle..."
          ></textarea>
          <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
        </div>

        <!-- Prioridad -->
        <div class="mb-6">
          <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Prioridad</label>
          <select
            v-model="form.priority"
            id="priority"
            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
          >
            <option value="baja">Baja</option>
            <option value="media">Media</option>
            <option value="alta">Alta</option>
          </select>
          <p v-if="form.errors.priority" class="text-red-500 text-sm mt-1">{{ form.errors.priority }}</p>
        </div>

        <!-- Botón -->
        <div class="flex justify-end">
          <button
            type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition duration-150"
            :disabled="form.processing"
          >
            Guardar Ticket
          </button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'

const form = useForm({
  title: '',
  description: '',
  priority: 'media',
})

function submit() {
  form.post(route('tickets.store'))
}
</script>
