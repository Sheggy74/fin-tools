<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12">
        <BrandSummary />
      </v-col>

      <v-col cols="12" md="6">
        <MentionTrendsChart />
      </v-col>

      <v-col cols="12" md="6">
        <SentimentOverview />
      </v-col>

      <v-col cols="12" md="6">
        <SourceDistribution />
      </v-col>

      <v-col cols="12" md="6">
        <MentionsTable />
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import BrandSummary from '@/components/Dashboard/BrandSummary.vue'
import MentionsTrendsChart from '@/components/Dashboard/MentionsTrendsChart.vue'
import MentionsTable from '@/components/Dashboard/MentionsTable.vue'
import SentimentOverview from '@/components/Dashboard/SentimentOverview.vue'
import SourceDistribution from '@/components/Dashboard/SourceDistribution.vue'
</script>
