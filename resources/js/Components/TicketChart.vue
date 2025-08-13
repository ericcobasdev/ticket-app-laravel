<template>
  <div class="bg-white p-6 rounded shadow max-w-xl mx-auto">
    <canvas ref="chartCanvas"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Chart from 'chart.js/auto'

const props = defineProps({
  chartData: Object
})

const chartCanvas = ref(null)

onMounted(() => {
  new Chart(chartCanvas.value, {
    type: 'doughnut',
    data: {
      labels: Object.keys(props.chartData),
      datasets: [
        {
          data: Object.values(props.chartData),
          backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#ef4444']
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  })
})
</script>
