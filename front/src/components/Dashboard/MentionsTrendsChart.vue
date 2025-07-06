<template>
  <v-card class="pa-4" elevation="2">
    <h3>Динамика упоминаний</h3>
    <canvas ref="chart"></canvas>
  </v-card>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { Chart } from 'chart.js/auto'

const chart = ref(null)

onMounted(() => {
  new Chart(chart.value, {
    type: 'line',
    data: {
      labels: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'],
      datasets: [
        {
          label: 'Упоминания',
          data: [120, 150, 180, 130, 170, 200, 250],
          fill: false,
          borderColor: '#1976D2',
          tension: 0.3
        }
      ]
    }
  })
})
</script>
