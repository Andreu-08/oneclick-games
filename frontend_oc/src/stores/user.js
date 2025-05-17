import { defineStore } from 'pinia'
import { login as loginApi, logout as logoutApi } from '@/services/auth'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    token: localStorage.getItem('token') || null
  }),

  getters: {
    // Devuelve true si el usuario tiene sesión iniciada
    isAuthenticated: (state) => !!state.token
  },

  actions: {
    // Inicia sesión y guarda los datos en el estado y localStorage
    async login(nickname, pin) {
      try {
        const respuesta = await loginApi(nickname, pin)

        this.user = respuesta.user
        this.token = respuesta.access_token

        localStorage.setItem('user', JSON.stringify(respuesta.user))
        localStorage.setItem('token', respuesta.access_token)

        return { success: true, registered: respuesta.registered }
      } catch (error) {
        return {
          success: false,
          message: error.response?.data?.message || 'Error al iniciar sesión'
        }
      }
    },

    // Cierra sesión y limpia el estado
    async logout() {
      try {
        if (this.token) {
          await logoutApi(this.token)
        }
      } catch (error) {
        console.warn('Error al cerrar sesión:', error)
      }

      this.user = null
      this.token = null

      localStorage.removeItem('user')
      localStorage.removeItem('token')
    }
  }
})
