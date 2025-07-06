<template>
  <v-app>
    <app-header v-if="auth.isAuthenticated" @toggle-drawer="toggleDrawer()" @logout="logout" @open-profile="openProfileSettings" />
    <app-drawer v-if="auth.isAuthenticated" v-model="drawer" />
    <v-main>
      <v-container fluid>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script setup>
import { ref } from 'vue'
import AppHeader from '../components/Base/AppHeader.vue'
import AppDrawer from '../components/Base/AppDrawer.vue'
import { useAuthStore } from '@/stores/auth'
import router from '@/router'


const drawer = ref(false)
const auth = useAuthStore()

function toggleDrawer(){
    drawer.value= !drawer.value
    console.log(drawer.value);    
}

function logout() {
  auth.logout()
  router.push({name: 'Auth'})
}

function openProfileSettings() {
  console.log('Открытие настроек профиля')
}
</script>
