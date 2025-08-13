<template>
  <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Editar Ticket</h1>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Título</label>
        <input v-model="form.title" type="text" class="input w-full" />
      </div>

      <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Descripción</label>
        <textarea v-model="form.description" class="input w-full h-24"></textarea>
      </div>

      <div class="mb-4">
        <label class="block font-medium text-sm text-gray-700">Prioridad</label>
        <select v-model="form.priority" class="input w-full">
          <option value="baja">Baja</option>
          <option value="media">Media</option>
          <option value="alta">Alta</option>
        </select>
      </div>

      <!-- Mostrar status solo si el usuario es técnico o admin -->
      <div class="mb-4" v-if="canEditStatus">
        <label class="block font-medium text-sm text-gray-700">Estado</label>
        <select v-model="form.status" class="input w-full">
          <option value="abierto">Abierto</option>
          <option value="asignado">Asignado</option>
          <option value="resuelto">Resuelto</option>
          <option value="cerrado">Cerrado</option>
        </select>
      </div>

      <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
        Guardar cambios
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { defineProps, computed } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
defineOptions({ layout: AppLayout })

const props = defineProps({
  ticket: Object,
})

const page = usePage()
const userRole = computed(() => page.props.auth.user.role)

const canEditStatus = computed(() =>
  userRole.value === 'admin' || userRole.value === 'tecnico'
)

const form = useForm({
  title: props.ticket.title,
  description: props.ticket.description,
  priority: props.ticket.priority,
  status: props.ticket.status,
})

function submit() {
  form.put(`/tickets/${props.ticket.id}`)
}
</script>

<style scoped>
.input {
  border: 1px solid #d1d5db;
  border-radius: 6px;
  padding: 8px;
  font-size: 14px;
}
</style>
