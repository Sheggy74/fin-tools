<template>
  <v-app-bar app color="primary" dark>
    <v-app-bar-nav-icon @click="$emit('toggle-drawer')" />
    <v-toolbar-title>MyFinTools</v-toolbar-title>
    <v-spacer />
    <v-btn icon @click="$emit('open-profile')">
      <v-icon>mdi-account-cog</v-icon>
    </v-btn>
    <v-btn icon @click="$emit('logout')">
      <v-icon>mdi-logout</v-icon>
    </v-btn>
  </v-app-bar>
</template>