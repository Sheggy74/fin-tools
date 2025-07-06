<template>
  <v-card class="pa-4" elevation="2">
    <h3>Последние упоминания</h3>
    <v-data-table
      :headers="headers"
      :items="mentions"
      :items-per-page="5"
    />
  </v-card>
</template>

<script setup>
const headers = [
  { text: 'Источник', value: 'source' },
  { text: 'Дата', value: 'date' },
  { text: 'Текст', value: 'text' },
  { text: 'Тональность', value: 'sentiment' }
]

const mentions = [
  { source: 'Twitter', date: '2025-05-10', text: 'Отличный бренд!', sentiment: 'Позитив' },
  { source: 'VK', date: '2025-05-09', text: 'Не понравилось обслуживание.', sentiment: 'Негатив' },
  // ...
]
</script>
