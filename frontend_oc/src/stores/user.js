import { defineStore } from 'pinia'
import { login as loginApi } from '@/services/auth'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    token: null
  }),
  actions: {
    async login(nickname, pin) {
      try {
        const res = await loginApi(nickname, pin)
        this.user = res.user
        this.token = res.access_token
        return { success: true, registered: res.registered }
      } catch (error) {
        return { success: false, message: error.response?.data?.message || 'Error al iniciar sesión' }
      }
    },
    logout() {
      this.user = null
      this.token = null
    }
  }
})
