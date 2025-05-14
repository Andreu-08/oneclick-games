<template>
  <div class="bg-yellow-100 rounded-2xl shadow-xl p-8 min-h-[350px] flex flex-col gap-6 items-center justify-center">
    <form @submit.prevent="emitirEnvio" class="flex flex-col gap-4 w-full max-w-md">
      <div class="flex flex-col gap-1 w-full">
        <label for="nickname" class="font-bold text-blue-900 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
          Nombre de usuario
        </label>
        <input
          id="nickname"
          :value="nickname"
          type="text"
          placeholder="Introduce tu nombre"
          class="p-4 rounded-xl border-2 border-blue-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-300 bg-white/80 text-lg w-full transition-all outline-none shadow-inner"
          required
          @input="$emit('update:nickname', $event.target.value)"
          @focus="emitirCampoActivo('nickname')"
          :aria-invalid="errorNickname ? 'true' : 'false'"
        />
        <span v-if="errorNickname" class="text-sm text-red-600 font-semibold" role="alert">{{ errorNickname }}</span>
      </div>
      <div class="flex flex-col gap-1 w-full">
        <label for="pin" class="font-bold text-blue-900 flex items-center gap-2">
          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 10-4 0v2c0 1.104.896 2 2 2zm6 2v5a2 2 0 01-2 2H8a2 2 0 01-2-2v-5a2 2 0 012-2h8a2 2 0 012 2z" /></svg>
          PIN de acceso
        </label>
        <input
          id="pin"
          :value="pin"
          @input="actualizarPin($event.target.value)"
          type="password"
          :maxlength="LONGITUD_PIN"
          placeholder="PIN (4 dígitos)"
          class="p-4 rounded-xl border-2 border-blue-200 focus:border-blue-600 focus:ring-2 focus:ring-blue-300 bg-white/80 text-lg w-full tracking-widest transition-all outline-none shadow-inner"
          required
          inputmode="numeric"
          pattern="[0-9]*"
          :aria-invalid="errorPin ? 'true' : 'false'"
        />
        <span v-if="errorPin" class="text-sm text-red-600 font-semibold" role="alert">{{ errorPin }}</span>
      </div>
      <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xl py-3 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-400 shadow-lg transition-all cursor-pointer hover:scale-105"
      >
        JUGAR
      </button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'FormularioLogin',
  props: {
    nickname: String,
    pin: String,
    errorNickname: String,
    errorPin: String,
    LONGITUD_PIN: Number
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
