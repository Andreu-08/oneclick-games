<template>
  <div class="bg-yellow-100 rounded-2xl shadow-xl p-8 flex flex-col gap-6 items-center justify-center">
    <form @submit.prevent="emitirEnvio" class="flex flex-col gap-4 w-full max-w-md">

      <!-- Campo de nombre -->
      <div class="flex flex-col gap-1 w-full">
        <label for="nickname" class="font-semibold text-blue-900">Nombre de usuario</label>
        <input
          id="nickname"
          :value="nickname"
          type="text"
          placeholder="Introduce tu nombre"
          class="p-4 rounded-xl border-2 border-blue-200 bg-white text-lg w-full outline-none focus:ring-2 focus:ring-blue-300"
          required
          @input="$emit('update:nickname', $event.target.value)"
          @focus="emitirCampoActivo('nickname')"
        />
        <span v-if="errorNickname" class="text-sm text-red-600">{{ errorNickname }}</span>
      </div>

      <!-- Campo PIN -->
      <div class="flex flex-col gap-1 w-full">
        <label for="pin" class="font-semibold text-blue-900">PIN de acceso</label>
        <input
          id="pin"
          :value="pin"
          @input="actualizarPin($event.target.value)"
          type="password"
          :maxlength="LONGITUD_PIN"
          placeholder="PIN (4 dígitos)"
          class="p-4 rounded-xl border-2 border-blue-200 bg-white text-lg w-full tracking-widest outline-none focus:ring-2 focus:ring-blue-300"
          required
          inputmode="numeric"
          pattern="[0-9]*"
        />
        <span v-if="errorPin" class="text-sm text-red-600">{{ errorPin }}</span>
      </div>

      <!-- Botón con spinner -->
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 transition duration-200 text-white font-semibold text-xl py-3 rounded-full w-full cursor-pointer flex items-center justify-center gap-2"
        :disabled="cargando"
      >
        <span v-if="!cargando">JUGAR</span>
        <svg v-else class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
          viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor"
            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
        </svg>
      </button>

    </form>
  </div>
</template>
<!-- FormularioLogin.vue -->
<script>
export default {
  name: 'FormularioLogin',
  props: {
    nickname: String,
    pin: String,
    errorNickname: String,
    errorPin: String,
    LONGITUD_PIN: Number,
    cargando: Boolean
  },
  methods: {
    actualizarPin(valor) {
      this.$emit('update:pin', valor)
    },
    emitirEnvio() {
      this.$emit('enviarFormulario')
    },
    emitirCampoActivo(campo) {
      this.$emit('establecerCampoActivo', campo)
    }
  }
}
</script>

