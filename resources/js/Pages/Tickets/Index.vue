<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Tickets</h1>

    <!-- Botón para crear nuevo ticket solo si el usuario es tipo "usuario" -->
    <Link
      v-if="role === 'usuario'"
      href="/tickets/create"
      class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block"
    >
      + Crear Ticket
    </Link>

    <!-- Listado de tickets -->
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

        <p v-if="ticket.assigned_technician" class="text-sm mt-1 text-green-700">
          Asignado a: {{ ticket.assigned_technician.name }}
        </p>

        <!-- Sección para admin: asignar técnico -->
        <div v-if="role === 'admin'" class="mt-2">
          <form
            @submit.prevent="assignTechnician(ticket.id)"
            class="flex items-center gap-2"
          >
            <select
              v-model="assigned[ticket.id]"
              class="border px-2 py-1 rounded"
            >
              <option value="">-- Asignar técnico --</option>
              <option
                v-for="tech in technicians"
                :key="tech.id"
                :value="tech.id"
              >
                {{ tech.name }}
              </option>
            </select>

            <button
              type="submit"
              class="bg-green-600 text-white text-sm px-2 py-1 rounded"
            >
              Asignar
            </button>
          </form>
        </div>

        <!-- Botones comunes -->
        <div class="mt-2 flex gap-2">
          <Link
            :href="`/tickets/${ticket.id}/edit`"
            class="bg-blue-600 text-white px-3 py-1 rounded text-sm"
          >
            Editar
          </Link>

          <button
            @click="deleteTicket(ticket.id)"
            class="bg-orange-600 text-white px-3 py-1 rounded text-sm"
          >
            Eliminar
          </button>
        </div>

        <!-- Botón para cerrar ticket (solo usuario dueño y si está resuelto) -->
        <div
          v-if="role === 'usuario' && ticket.status === 'resuelto' && ticket.user_id === userId"
          class="mt-2"
        >
          <button
            @click="closeTicket(ticket.id)"
            class="bg-gray-800 text-white text-sm px-3 py-1 rounded"
          >
            Cerrar Ticket
          </button>
        </div>
      </li>
    </ul>

    <!-- Si no hay tickets -->
    <p v-else class="text-gray-500">No hay tickets disponibles.</p>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
defineOptions({ layout: AppLayout })

const props = defineProps({
  tickets: Array,
  technicians: Array,
})

const page = usePage()
const role = page.props.auth.user?.role || ''
const userId = page.props.auth.user?.id || null

const assigned = ref({})

// Inicializar técnicos asignados
onMounted(() => {
  props.tickets.forEach(ticket => {
    assigned.value[ticket.id] = ticket.assigned_to ?? ''
  })
})

// Eliminar ticket
function deleteTicket(id) {
  if (confirm('¿Seguro que deseas eliminar este ticket?')) {
    router.delete(`/tickets/${id}`)
  }
}

// Asignar técnico
function assignTechnician(ticketId) {
  const technicianId = assigned.value[ticketId]
  if (!technicianId) {
    alert('Selecciona un técnico antes de asignar.')
    return
  }

  router.put(`/tickets/${ticketId}/assign`, {
    assigned_to: technicianId,
  }, {
    preserveScroll: true,
    onSuccess: () => {
      console.log('Técnico asignado correctamente')
    },
    onError: (errors) => {
      console.error('Error al asignar técnico:', errors)
    }
  })
}

// Cerrar ticket (por usuario cuando está resuelto)
function closeTicket(ticketId) {
  if (!confirm('¿Confirmas que deseas cerrar este ticket?')) return

  router.put(`/tickets/${ticketId}/close`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      console.log('Ticket cerrado correctamente.')
    },
    onError: (errors) => {
      console.error('Error al cerrar ticket:', errors)
    }
  })
}

</script>













