<template>
  <div class="relative min-h-screen flex flex-col items-center justify-center px-4 text-gray-800">
    <!-- Fondo -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Contenido principal -->
    <div class="relative z-10 w-full max-w-6xl flex flex-col gap-6">

      <!-- Logo + título extraído a componente -->
      <TituloLogin />

      <!-- Formulario -->
      <FormularioLogin
        :nickname="nickname"
        :pin="pin"
        :errorNickname="errorNickname"
        :errorPin="errorPin"
        :LONGITUD_PIN="LONGITUD_PIN"
        @update:nickname="nickname = $event"
        @update:pin="pin = $event"
        @enviarFormulario="enviarFormulario"
        @establecerCampoActivo="campoActivo = $event"
      />

      <!-- Teclado visual -->
      <div class="grid grid-cols-5 gap-6 w-full">
        <!-- Letras -->
        <TecladoAlfabetico
          :alfabeto="ALFABETO"
          @tecla="escribirLetra"
          @retroceso="retroceso"
        />
        <!-- Números -->
        <TecladoNumerico
          :numeros="NUMEROS"
          @numero="escribirNumero"
          @borrar="borrarNumero"
        />
      </div>
    </div>
  </div>
</template>

<script>
import TituloLogin from '@/components/TituloLogin.vue'
import FormularioLogin from '@/components/FormularioLogin.vue'
import TecladoAlfabetico from '@/components/TecladoAlfabetico.vue'
import TecladoNumerico from '@/components/TecladoNumerico.vue'
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'
import { userExists } from '@/services/auth'

export default {
  name: 'LoginView',
  components: {
    TituloLogin,
    FormularioLogin,
    TecladoAlfabetico,
    TecladoNumerico
  },
  data() {
    return {
      
      // Constantes y textos
      ALFABETO: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split(''),
      NUMEROS: Array.from({ length: 10 }, (_, i) => i),
      LONGITUD_PIN: 4,
      nickname: '',
      pin: '',
      errorNickname: '',
      errorPin: '',
      campoActivo: 'nickname',
    }
  },
  setup() {
    const userStore = useUserStore()
    const router = useRouter()
    return { userStore, router }
  },
  methods: {
    escribirLetra(letra) {
      if (this.campoActivo === 'nickname') {
        this.nickname += letra
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
      const existe = await userExists(this.nickname)
      if (!existe) {
        const confirmar = confirm(`Vas a registrar al usuario: ${this.nickname}\n¿Deseas continuar?`)
        if (!confirmar) {
          return
        }
      }
      const result = await this.userStore.login(this.nickname, this.pin)
      if (result.success) {
        this.$router.push('/games')
      } else {
        // Mostrar error de login
        this.errorPin = result.message
      }
    }
  }
}
</script>



