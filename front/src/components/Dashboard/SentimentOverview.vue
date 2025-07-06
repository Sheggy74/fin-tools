<template>
  <v-card class="pa-4" elevation="2">
    <h3>Анализ тональности</h3>
    <canvas ref="sentimentChart"></canvas>
  </v-card>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { Chart } from 'chart.js/auto'

const sentimentChart = ref(null)

onMounted(() => {
  new Chart(sentimentChart.value, {
    type: 'doughnut',
    data: {
      labels: ['Позитив', 'Негатив', 'Нейтрально'],
      datasets: [{
        data: [812, 182, 254],
        backgroundColor: ['#4CAF50', '#F44336', '#FFC107']
      }]
    }
  })
})
</script>
