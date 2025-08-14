<script setup>
import { defineProps } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import TicketStatusChart from './Components/TicketStatusChart.vue'
defineOptions({ layout: AppLayout })

const props = defineProps({
  stats: Object
})
</script>




<template>
  <div>
    <h1 class="text-2xl font-bold mb-6">Panel de Administración</h1>

    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
      <div class="bg-white p-4 rounded shadow">Total de Tickets: <strong>{{ stats.total }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Abiertos: <strong>{{ stats.abiertos }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Asignados: <strong>{{ stats.asignados }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Resueltos: <strong>{{ stats.resueltos }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Cerrados: <strong>{{ stats.cerrados }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Usuarios: <strong>{{ stats.usuarios }}</strong></div>
      <div class="bg-white p-4 rounded shadow">Técnicos: <strong>{{ stats.tecnicos }}</strong></div>
    </div>

    <!-- Acciones rápidas -->
    <div class="flex flex-wrap gap-4 mb-8">
      <a href="/tickets" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Ver todos los Tickets</a>
      <!-- Puedes cambiar o comentar estos enlaces si aún no existen -->
      <!-- <a href="/usuarios" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Ver Usuarios</a> -->
      <!-- <a href="/tecnicos/create" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">Registrar Técnico</a> -->
    </div>

    <!-- Espacio para gráfico -->
    <div class="bg-white p-6 rounded shadow text-center text-gray-500">      
      <TicketStatusChart />    
    </div>
  </div>
</template>
