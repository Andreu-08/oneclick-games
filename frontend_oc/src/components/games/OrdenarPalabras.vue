<template>
  <div class="relative min-h-screen flex flex-col justify-start items-center px-4 pt-10 text-white">

    <!-- Fondo desenfocado -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenedor principal -->
    <div class="relative z-10 w-full max-w-3xl flex flex-col gap-8 items-center">

      <!-- 🔢 Puntos y ❤️ Vidas -->
      <div class="flex justify-between w-full items-center px-4">
        <div class="flex items-center gap-2 text-green-300 text-6xl font-bold">
          <img src="@/assets/icons/star.png" alt="Puntos" class="w-12 h-12" />
          {{ puntos }}
        </div>
        <div class="flex items-center gap-2 text-red-400 text-6xl font-bold">
          {{ vidas }}
          <img src="@/assets/icons/heart.png" alt="Vidas" class="w-15 h-15" />
        </div>
      </div>

      <!-- 🔡 Letras desordenadas -->
      <div class="flex flex-wrap justify-center gap-4 bg-purple-400 p-6 rounded-2xl shadow-inner w-full">
        <button
          v-for="(letra, i) in letrasDesordenadas"
          :key="i"
          @click="elegirLetra(i)"
          :disabled="letrasElegidas.includes(i)"
          class="bg-purple-800 text-white text-4xl uppercase px-6 py-4 rounded-2xl hover:bg-purple-700 disabled:opacity-40 transition shadow-md min-w-[70px] cursor-pointer"
        >
          {{ letra }}
        </button>
      </div>

      <!-- 🧩 Palabra formada -->
      <div class="flex justify-center gap-4 text-4xl font-extrabold font-mono tracking-widest">
        <span
          v-for="(letra, i) in palabraUsuario"
          :key="'letra' + i"
          class="uppercase border-b-4 border-blue-300 pb-2 w-12 text-center font-semibold"
        >
          {{ letra }}
        </span>
      </div>

      <!-- 🎮 Botones de acción estilo bento -->
      <div class="flex flex-wrap justify-center gap-10">
        <!-- Botón: borrar intento -->
        <button
          @click="borrarIntento"
          class="bg-amber-400 hover:bg-amber-500 text-white text-lg font-semibold px-6 py-3 rounded-xl transition min-w-[160px] shadow-md"
        >
          Borrar intento
        </button>

        <!-- Botón: siguiente palabra -->
        <button
          @click="siguientePalabra"
          class="bg-rose-500 hover:bg-rose-600 text-white text-lg font-semibold px-6 py-3 rounded-xl transition min-w-[160px] shadow-md"
        >
          Siguiente palabra
        </button>
      </div>

      <!-- 💬 Mensaje -->
      <p class="text-center text-lg font-semibold min-h-[2rem]">
        {{ mensaje }}
      </p>
    </div>
  </div>
</template>

<script>
import { getPalabraAleatoria } from '@/services/games'

export default {
  name: 'OrdenarPalabrasView',
  emits: ['finJuego'],
  data() {
    return {
      palabraCorrecta: '',
      letrasDesordenadas: [],
      palabraUsuario: [],
      letrasElegidas: [],
      mensaje: '',
      puntos: 0,
      vidas: 5
    }
  },
  mounted() {
    this.cargarPalabra()
  },
  methods: {
    // 🔄 Carga una nueva palabra válida de hasta 5 letras
    async cargarPalabra() {
      this.borrarIntento()
      try {
        let palabraValida = ''
        do {
          const palabra = await getPalabraAleatoria()
          if (palabra.length <= 5) {
            palabraValida = palabra.toLowerCase()
          }
        } while (!palabraValida)

        this.palabraCorrecta = palabraValida
        this.letrasDesordenadas = this.palabraCorrecta
          .split('')
          .sort(() => Math.random() - 0.5)

      } catch (error) {
        this.mensaje = 'No se pudo cargar la palabra'
      }
    },

    // 🖱️ Añade la letra seleccionada
    elegirLetra(posicion) {
      this.palabraUsuario.push(this.letrasDesordenadas[posicion])
      this.letrasElegidas.push(posicion)

      if (this.palabraUsuario.length === this.palabraCorrecta.length) {
        const intento = this.palabraUsuario.join('')
        if (intento === this.palabraCorrecta) {
          this.puntos++
          this.mensaje = '¡Bien hecho!'
        } else {
          this.vidas--
          this.mensaje = `¡Fallaste! La palabra era "${this.palabraCorrecta}".`
        }

        setTimeout(() => {
          if (this.vidas === 0) {
            this.$emit('finJuego', this.puntos)
          } else {
            this.cargarPalabra()
          }
        }, 1500)
      }
    },

    // 🔙 Borra el intento actual
    borrarIntento() {
      this.palabraUsuario = []
      this.letrasElegidas = []
      this.mensaje = ''
    },

    // ⏭️ Cambia de palabra, restando una vida
    siguientePalabra() {
      this.vidas--
      if (this.vidas === 0) {
        this.$emit('finJuego', this.puntos)
      } else {
        this.cargarPalabra()
      }
    },

    // 🔁 Reinicia el juego completo
    reiniciarJuego() {
      this.puntos = 0
      this.vidas = 5
      this.cargarPalabra()
    }
  }
}
</script>
