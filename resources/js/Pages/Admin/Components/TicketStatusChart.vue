<template>
    <div>
      <h2 class="text-xl font-bold mb-4">Tickets por estado</h2>
      <div class="w-full flex justify-center">
      <div class="w-[400px] h-[300px]">
      <canvas ref="chartRef"></canvas>
    </div>
    </div>
    </div>

    

  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue'
  import { Chart, registerables } from 'chart.js'
  Chart.register(...registerables)
  
  const chartRef = ref(null)
  
  onMounted(async () => {
    const response = await fetch('/admin/dashboard/stats')
    const data = await response.json()
  
    const labels = Object.keys(data)
    const values = Object.values(data)
  
    new Chart(chartRef.value, {
      type: 'pie',
      data: {
        labels: labels,
        datasets: [{
          label: 'Tickets',
          data: values,
          backgroundColor: [
            '#4ade80', // verde
            '#60a5fa', // azul
            '#facc15', // amarillo
            '#f87171', // rojo
          ],
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'bottom',
          },
        }
      }
    })
  })
  </script>
  