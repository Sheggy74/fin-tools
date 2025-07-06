// Utilities
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null
  }),

  getters: {
    isAuthenticated: (state) => !!state.user
  },

  actions: {
    login(userData) {
      this.user = userData
    },
    logout() {
      this.user = null
    }
  }
})
