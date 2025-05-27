<template>
  <div class="text-white text-center mt-8 px-4">
    <div class="mb-6 text-2xl font-bold flex justify-between items-center px-4">
      <span class="text-green-300">Puntos: {{ puntos }}</span>
      <span class="text-red-400">Vidas: {{ vidas }}</span>
    </div>

    <div class="flex flex-wrap justify-center gap-4 mb-6">
      <button
        v-for="(letra, i) in letrasDesordenadas"
        :key="i"
        @click="elegirLetra(i)"
        :disabled="letrasElegidas.includes(i)"
        class="bg-blue-600 text-white text-2xl px-6 py-3 rounded-2xl hover:bg-blue-700 disabled:opacity-40 shadow-md"
      >
        {{ letra }}
      </button>
    </div>

    <div class="flex justify-center gap-3 mb-6 text-3xl font-extrabold font-mono tracking-wide">
      <span
        v-for="(letra, i) in palabraUsuario"
        :key="'letra' + i"
        class="border-b-4 border-blue-400 pb-1"
      >
        {{ letra }}
      </span>
    </div>

    <div class="mb-4">
      <button
        @click="borrarIntento"
        class="bg-yellow-500 text-white text-xl px-6 py-3 rounded-xl hover:bg-yellow-600 shadow"
      >
        Borrar intento
      </button>
    </div>

    <p class="text-lg font-semibold min-h-[2rem]">{{ mensaje }}</p>
  </div>
</template>

<script>
import { getPalabraAleatoria } from '@/services/games'

export default {
  name: 'OrdenarPalabrasView',
  data() {
    return {
      palabraCorrecta: '',
      letrasDesordenadas: [],
      palabraUsuario: [],
      letrasElegidas: [],
      mensaje: '',
      puntos: 0,
      vidas: 10
    }
  },
  mounted() {
    this.cargarPalabra()
  },
  methods: {
    async cargarPalabra() {
      this.borrarIntento()
      try {
        const palabra = await getPalabraAleatoria()
        this.palabraCorrecta = palabra.toLowerCase()
        this.letrasDesordenadas = this.palabraCorrecta.split('').sort(() => Math.random() - 0.5)
      } catch (error) {
        this.mensaje = 'No se pudo cargar la palabra'
      }
    },
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
            alert(`Juego terminado. Has conseguido ${this.puntos} puntos.`)
            this.reiniciarJuego()
          } else {
            this.cargarPalabra()
          }
        }, 1500)
      }
    },
    borrarIntento() {
      this.palabraUsuario = []
      this.letrasElegidas = []
      this.mensaje = ''
    },
    reiniciarJuego() {
      this.puntos = 0
      this.vidas = 10
      this.cargarPalabra()
    }
  }
}
</script>
