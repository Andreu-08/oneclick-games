import { defineStore } from 'pinia'
import { login as loginApi } from '@/services/auth'

export const useUserStore = defineStore('user', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,   // Almacena el usuario actual
    token: localStorage.getItem('token') || null              // Almacena el token JWT
  }),

  getters: {
    /**
     * Devuelve true si hay token → el usuario está autenticado
     */
    isAuthenticated: (state) => !!state.token
  },

  actions: {
    /**
     * Inicia sesión con nickname y pin
     * Guarda user y token en el estado y en localStorage
     */
    async login(nickname, pin) {
      try {
        const res = await loginApi(nickname, pin)

        // Actualizar estado
        this.user = res.user
        this.token = res.access_token

        // Guardar en localStorage para mantener sesión tras recarga
        localStorage.setItem('user', JSON.stringify(res.user))
        localStorage.setItem('token', res.access_token)

        return { success: true, registered: res.registered }
      } catch (error) {
        return {
          success: false,
          message: error.response?.data?.message || 'Error al iniciar sesión'
        }
      }
    },

    /**
     * Cierra sesión y elimina token y usuario del estado y localStorage
     */
    logout() {
      this.user = null
      this.token = null

      localStorage.removeItem('user')
      localStorage.removeItem('token')
    }
  }
})
