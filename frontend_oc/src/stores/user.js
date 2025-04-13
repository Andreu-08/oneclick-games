import { defineStore } from 'pinia'
import api from '@/services/axios'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    token: null
  }),
  actions: {
    async login(email, password) {
      try {
        const res = await api.post('/login', { email, password })
        this.user = res.data.user
        this.token = res.data.token
      } catch (error) {
        console.error('Error al iniciar sesión:', error)
      }
    },
    logout() {
      this.user = null
      this.token = null
    }
  }
})
