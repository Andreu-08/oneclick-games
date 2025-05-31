<template>
  <div class="relative min-h-screen flex flex-col items-center justify-center px-4 text-gray-800">
    <!-- Fondo -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full max-w-6xl flex flex-col gap-6">
      <TituloVistas titulo="ACCEDE A LOS JUEGOS" />

      <FormularioLogin
        :nickname="nickname"
        :pin="pin"
        :errorNickname="errorNickname"
        :errorPin="errorPin"
        :LONGITUD_PIN="LONGITUD_PIN"
        :cargando="cargando"
        @update:nickname="nickname = $event.toUpperCase()"
        @update:pin="pin = $event"
        @enviarFormulario="enviarFormulario"
        @establecerCampoActivo="campoActivo = $event"
      />

      <!-- Teclado visual con ID para tutorial -->
      <div id="login-teclado" class="grid grid-cols-5 gap-6 w-full hidden md:grid">
        <TecladoAlfabetico
          :alfabeto="ALFABETO"
          @tecla="escribirLetra"
          @retroceso="retroceso"
        />
        <TecladoNumerico
          :numeros="NUMEROS"
          @numero="escribirNumero"
          @borrar="borrarNumero"
        />
      </div>
    </div>

    <!-- Modal de confirmación -->
    <ModalConfirmacion
      v-if="modalConfirmacion"
      :nickname="nickname"
      @cancelar="cancelarConfirmacion"
      @confirmar="confirmarRegistro"
    />
  </div>
</template>

<script>
import TituloVistas from '@/components/TituloVistas.vue'
import FormularioLogin from '@/components/FormularioLogin.vue'
import TecladoAlfabetico from '@/components/TecladoAlfabetico.vue'
import TecladoNumerico from '@/components/TecladoNumerico.vue'
import ModalConfirmacion from '@/components/modales/ModalConfirmacion.vue'

import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'
import { userExists } from '@/services/auth'

import { driver } from 'driver.js'
import 'driver.js/dist/driver.css'

export default {
  name: 'LoginView',
  components: {
    TituloVistas,
    FormularioLogin,
    TecladoAlfabetico,
    TecladoNumerico,
    ModalConfirmacion
  },
  data() {
    return {
      ALFABETO: 'ABCDEFGHIJKLMNÑOPQRSTUVWXYZ'.split(''),
      NUMEROS: Array.from({ length: 10 }, (_, i) => i),
      LONGITUD_PIN: 4,
      nickname: '',
      pin: '',
      errorNickname: '',
      errorPin: '',
      campoActivo: 'nickname',
      userStore: useUserStore(),
      router: useRouter(),
      modalConfirmacion: false,
      intentoLogin: false,
      cargando: false
    }
  },
  mounted() {
    if (!localStorage.getItem('tutorial_login_done')) {
      this.iniciarTutorialLogin()
      localStorage.setItem('tutorial_login_done', 'true')
    }
  },
  methods: {
    async iniciarTutorialLogin() {
      const driverObj = driver({
        popoverClass: 'driverjs-theme',
        nextBtnText: 'Siguiente',
        prevBtnText: 'Anterior',
        doneBtnText: 'Aceptar',
        allowClose: false,
        steps: [
          {
            element: '#login-nickname',
            popover: {
              title: 'Introduce un nickname para registrarte o iniciar sesión.',
              description: '',
              side: 'left',
              align: 'center'
            }
          },
          {
            element: '#login-pin',
            popover: {
              title: 'Introduce tu PIN de acceso o crea uno nuevo.',
              description: '',
              side: 'right',
              align: 'center'
            }
          },
          {
            element: '#login-teclado',
            popover: {
              title: 'Puedes utilizar los teclados de la pantalla si lo necesitas.',
              description: '',
              side: 'top',
              align: 'center'
            }
          },
          {
            element: '#login-enviar',
            popover: {
              title: 'Empieza a JUGAR!',
              description: '',
              side: 'top',
              align: 'center'
            }
          }
        ]
      })

      driverObj.drive()
    },
    escribirLetra(letra) {
      if (this.campoActivo === 'nickname') {
        this.nickname += letra.toUpperCase()
      }
    },
    retroceso() {
      if (this.campoActivo === 'nickname') {
        this.nickname = this.nickname.slice(0, -1)
      }
    },
    escribirNumero(numero) {
      if (this.pin.length < this.LONGITUD_PIN) {
        this.pin += numero.toString()
      }
    },
    borrarNumero() {
      this.pin = this.pin.slice(0, -1)
    },
    validar() {
      this.errorNickname = ''
      this.errorPin = ''

      if (!this.nickname.trim()) {
        this.errorNickname = 'El nombre es obligatorio.'
      }
      if (!/^\d{4}$/.test(this.pin)) {
        this.errorPin = 'El PIN debe tener 4 dígitos numéricos.'
      }

      return !this.errorNickname && !this.errorPin
    },
    async enviarFormulario() {
      if (!this.validar()) return
      this.cargando = true

      try {
        const existe = await userExists(this.nickname)
        if (!existe) {
          this.modalConfirmacion = true
          this.intentoLogin = true
          return
        }
        await this.realizarLogin()
      } catch (error) {
        this.errorPin = 'Error al conectar con el servidor.'
      } finally {
        this.cargando = false
      }
    },
    async realizarLogin() {
      const result = await this.userStore.login(this.nickname, this.pin)
      if (result.success) {
        this.router.push('/games')
      } else {
        this.errorPin = result.message
      }
    },
    cancelarConfirmacion() {
      this.modalConfirmacion = false
      this.intentoLogin = false
    },
    async confirmarRegistro() {
      this.modalConfirmacion = false
      if (this.intentoLogin) {
        this.cargando = true
        await this.realizarLogin()
        this.cargando = false
      }
    }
  }
}
</script>
