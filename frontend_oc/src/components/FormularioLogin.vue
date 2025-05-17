<template>
  <div class="bg-yellow-100 rounded-2xl shadow-xl p-8 flex flex-col gap-6 items-center justify-center">
    <form @submit.prevent="emitirEnvio" class="flex flex-col gap-4 w-full max-w-md">

      <!-- Campo de nombre -->
      <div class="flex flex-col gap-1 w-full">
        <label for="nickname" class="font-bold text-blue-900">Nombre de usuario</label>
        <input id="nickname" :value="nickname" type="text" placeholder="Introduce tu nombre"
          class="p-4 rounded-xl border-2 border-blue-200 bg-white text-lg w-full outline-none focus:ring-2 focus:ring-blue-300"
          required @input="$emit('update:nickname', $event.target.value)" @focus="emitirCampoActivo('nickname')" />
        <span v-if="errorNickname" class="text-sm text-red-600 font-semibold">{{ errorNickname }}</span>
      </div>

      <!-- Campo PIN -->
      <div class="flex flex-col gap-1 w-full">
        <label for="pin" class="font-bold text-blue-900">PIN de acceso</label>
        <input id="pin" :value="pin" @input="actualizarPin($event.target.value)" type="password"
          :maxlength="LONGITUD_PIN" placeholder="PIN (4 dígitos)"
          class="p-4 rounded-xl border-2 border-blue-200 bg-white text-lg w-full tracking-widest outline-none focus:ring-2 focus:ring-blue-300"
          required inputmode="numeric" pattern="[0-9]*" />
        <span v-if="errorPin" class="text-sm text-red-600 font-semibold">{{ errorPin }}</span>
      </div>

      <!-- Botón -->
      <button type="submit"
        class="bg-blue-600 hover:bg-blue-700 hover:scale-105 transition duration-200 text-white font-bold text-xl py-3 rounded-full w-full cursor-pointer">
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
