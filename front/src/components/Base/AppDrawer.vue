<template>
  <v-navigation-drawer v-model="drawer" app>
    <v-list dense>
      <v-list-item to="/" link>
        <v-list-item prepend-icon="mdi-view-dashboard"><v-list-item-title>Главная</v-list-item-title></v-list-item>
      </v-list-item>
      <v-list-item to="/security-list" link>        
        <v-list-item prepend-icon="mdi-tag-multiple"><v-list-item-title>Ценные бумаги</v-list-item-title></v-list-item>
      </v-list-item>      
    </v-list>
  </v-navigation-drawer>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])

const drawer = computed({
  get: () => props.modelValue,
  set: (val) => emit('update:modelValue', val),
})
</script>
