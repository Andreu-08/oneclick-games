<template>
  <div class="relative min-h-screen flex flex-col items-center justify-center px-4 text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Grid principal -->
    <div class="relative z-10 w-full max-w-6xl grid grid-rows-[auto_auto] gap-6">

      <!-- Formulario -->
      <div class="bg-yellow-100 rounded-2xl shadow-xl p-8 min-h-[350px] flex flex-col gap-6 items-center justify-center">
        <h2 class="text-4xl font-extrabold text-center text-blue-900">Accede a OneClick Games</h2>

        <!-- Formulario -->
        <form @submit.prevent="submit" class="flex flex-col gap-4 w-full max-w-md">
          <!-- Nickname -->
          <input
            v-model="nickname"
            type="text"
            placeholder="Nombre de jugador"
            class="p-4 rounded-xl border border-gray-300 text-lg w-full"
            required
            ref="inputNickname"
            @focus="setActiveField('nickname')"
          />

          <!-- PIN -->
          <input
            v-model="pin"
            type="password"
            maxlength="4"
            placeholder="PIN (4 dígitos)"
            class="p-4 rounded-xl border border-gray-300 text-lg w-full"
            required
          />

          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xl py-3 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-400"
          >
            JUGAR
          </button>
        </form>
      </div>

      <!-- Teclado -->
      <div class="grid grid-cols-5 gap-6 w-full">
        <!-- Letras -->
        <div class="col-span-3 bg-green-100 rounded-2xl shadow-xl p-6 min-h-[200px] flex flex-wrap justify-center gap-2">
          <button
            v-for="key in alphabet"
            :key="key"
            class="bg-white text-lg font-bold px-4 py-2 rounded-xl shadow hover:bg-green-200 transition"
            @click="typeLetter(key)"
          >
            {{ key }}
          </button>
          <button
            class="bg-red-200 text-lg font-bold px-4 py-2 rounded-xl shadow hover:bg-red-300 transition"
            @click="backspace"
          >
            ←
          </button>
        </div>

        <!-- PIN info -->
        <div class="col-span-2 bg-blue-100 rounded-2xl shadow-xl p-6 min-h-[200px] flex flex-col items-center justify-center">
          <p class="text-center text-lg">Introduce tu PIN numérico de 4 dígitos para acceder o registrarte</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'

const nickname = ref('')
const pin = ref('')

const inputNickname = ref(null)
const activeField = ref('nickname')

const setActiveField = (field) => {
  activeField.value = field
  nextTick(() => {
    if (field === 'nickname' && inputNickname.value) {
      inputNickname.value.focus()
    }
  })
}

const typeLetter = (letter) => {
  if (activeField.value === 'nickname' && inputNickname.value) {
    nickname.value += letter
    inputNickname.value.focus()
  }
}

const backspace = () => {
  if (activeField.value === 'nickname') {
    nickname.value = nickname.value.slice(0, -1)
    inputNickname.value?.focus()
  }
}

const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('')

const submit = () => {
  const payload = {
    nickname: nickname.value,
    pin: pin.value
  }

  console.log('Formulario enviado:', payload)
}
</script>


<style scoped>
/* Estilos adicionales si los necesitas */
</style>
