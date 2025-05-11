<template>
  <div class="relative min-h-screen flex flex-col items-center justify-center px-4 text-gray-800">
    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-no-repeat bg-center brightness-50"></div>

    <!-- Grid bento principal -->
    <div class="relative z-10 w-full max-w-6xl grid grid-rows-[auto_auto] gap-6">

      <!-- FORMULARIO LOGIN / REGISTRO -->
      <div class="bg-yellow-100 rounded-2xl shadow-xl p-8 min-h-[350px] flex flex-col gap-6 items-center justify-center">
        <h2 class="text-4xl font-extrabold text-center text-blue-900">Accede a OneClick Games</h2>

        <!-- Selector: ya ha jugado o no -->
        <div class="flex gap-8 text-lg font-semibold">
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="radio" v-model="isRegister" :value="false" class="w-5 h-5 accent-blue-600" />
            <span class="text-blue-800">Ya he jugado</span>
          </label>
          <label class="flex items-center gap-3 cursor-pointer">
            <input type="radio" v-model="isRegister" :value="true" class="w-5 h-5 accent-green-600" />
            <span class="text-green-800">Nunca he jugado</span>
          </label>
        </div>

        <!-- Formulario -->
        <form @submit.prevent="submit" class="flex flex-col gap-4 w-full max-w-md">
          <!-- Nombre -->
          <input
            v-model="nombre"
            type="text"
            placeholder="Nombre"
            class="p-4 rounded-xl border border-gray-300 text-lg w-full"
            required
            ref="inputNombre"
            @focus="setActiveField('nombre')"
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

          <!-- Email (solo si registro) -->
          <input
            v-if="isRegister"
            v-model="email"
            type="email"
            placeholder="Email"
            class="p-4 rounded-xl border border-gray-300 text-lg w-full"
            required
            ref="inputEmail"
            @focus="setActiveField('email')"
          />

          <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xl py-3 rounded-full focus:outline-none focus:ring-4 focus:ring-blue-400"
          >
            JUGAR
          </button>
        </form>
      </div>

      <!-- FILA CON TECLADO LETRAS Y NÚMEROS -->
      <div class="grid grid-cols-5 gap-6 w-full">
        <!-- TECLADO LETRAS -->
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

        <!-- NÚMEROS PIN -->
        <div class="col-span-2 bg-blue-100 rounded-2xl shadow-xl p-6 min-h-[200px]">
          <p class="text-center text-lg">Números del 0 al 9</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'

const email = ref('')
const nombre = ref('')
const pin = ref('')
const isRegister = ref(false)

const inputNombre = ref(null)
const inputEmail = ref(null)

const activeField = ref('nombre') // 'nombre' o 'email'

const setActiveField = (field) => {
  activeField.value = field
  nextTick(() => {
    if (field === 'nombre' && inputNombre.value) {
      inputNombre.value.focus()
    } else if (field === 'email' && inputEmail.value) {
      inputEmail.value.focus()
    }
  })
}

const typeLetter = (letter) => {
  if (activeField.value === 'nombre' && inputNombre.value) {
    nombre.value += letter
    inputNombre.value.focus()
  } else if (activeField.value === 'email' && inputEmail.value) {
    email.value += letter
    inputEmail.value.focus()
  }
}

const backspace = () => {
  if (activeField.value === 'nombre') {
    nombre.value = nombre.value.slice(0, -1)
    inputNombre.value?.focus()
  } else if (activeField.value === 'email') {
    email.value = email.value.slice(0, -1)
    inputEmail.value?.focus()
  }
}

const alphabet = 'abcdefghijklmnopqrstuvwxyz@'.split('')

const submit = async () => {
  const payload = {
    name: nombre.value,
    pin: pin.value,
    is_register: isRegister.value,
    email: isRegister.value ? email.value : null,
  }

  console.log('Formulario enviado:', payload)
  // await useUserStore().login(payload)
}
</script>

<style scoped>
/* Estilo adicional si lo necesitas */
</style>
