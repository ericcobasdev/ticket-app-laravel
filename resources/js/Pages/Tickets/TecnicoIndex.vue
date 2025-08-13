<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Mis Tickets Asignados</h1>

    <ul v-if="tickets.length > 0" class="space-y-4">
      <li
        v-for="ticket in tickets"
        :key="ticket.id"
        class="p-4 border rounded shadow"
      >
        <h2 class="text-lg font-semibold">{{ ticket.title }}</h2>
        <p class="text-sm text-gray-600">{{ ticket.description }}</p>
        <p class="text-sm">Prioridad: {{ ticket.priority }}</p>
        <p class="text-sm">Estado: {{ ticket.status }}</p>
        <p class="text-sm mt-1 text-green-700">
          Creado por: {{ ticket.user.name }}
        </p>

        <!-- Mostrar botón solo si está asignado y el técnico actual es el asignado -->
        <div v-if="ticket.status === 'asignado' && ticket.assigned_to === currentUserId" class="mt-2">
          <button
            @click="markAsResolved(ticket.id)"
            class="bg-blue-600 text-white px-4 py-1 rounded text-sm"
          >
            Marcar como resuelto
          </button>
        </div>
      </li>
    </ul>

    <p v-else class="text-gray-500">No tienes tickets asignados.</p>
  </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
defineOptions({ layout: AppLayout })

const page = usePage()
const currentUserId = page.props.auth.user.id

const props = defineProps({
  tickets: Array,
})

function markAsResolved(ticketId) {
  if (!confirm('¿Confirmas que deseas marcar este ticket como resuelto?')) return

  router.put(`/tickets/${ticketId}/resolve`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      console.log('Ticket marcado como resuelto.')
    },
    onError: (errors) => {
      console.error('Error al resolver ticket:', errors)
    }
  })
}

</script>

