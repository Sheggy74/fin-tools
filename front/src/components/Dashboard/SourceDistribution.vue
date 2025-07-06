<template>
  <v-card class="pa-4" elevation="2">
    <h3>Распределение по источникам</h3>
    <canvas ref="sourceChart"></canvas>
  </v-card>
</template>

<script setup>
import { onMounted, ref } from 'vue'

import { Chart } from 'chart.js/auto'

const sourceChart = ref(null)

onMounted(() => {
  new Chart(sourceChart.value, {
    type: 'bar',
    data: {
      labels: ['Twitter', 'VK', 'Facebook', 'Instagram'],
      datasets: [
        {
          label: 'Количество',
          data: [320, 280, 190, 458],
          backgroundColor: '#42A5F5'
        }
      ]
    }
  })
})
</script>
