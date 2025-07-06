<template>
  <v-card class="pa-4" elevation="2">
    <v-row>
      <v-col>
        <h2>{{ brandName }}</h2>
        <div>Общее количество упоминаний: {{ totalMentions }}</div>
        <div>Позитивных: {{ sentiment.positive }}</div>
        <div>Негативных: {{ sentiment.negative }}</div>
      </v-col>
    </v-row>
  </v-card>
</template>

<script setup>
const brandName = 'MyBrand'
const totalMentions = 1248
const sentiment = {
  positive: 812,
  negative: 182,
  neutral: 254
}
</script>
