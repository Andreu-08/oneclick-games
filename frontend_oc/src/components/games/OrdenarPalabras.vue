<template>
  <!-- Estructura principal del juego -->
  <div class="relative min-h-screen flex flex-col justify-start items-center px-4 pt-10 text-white">

    <!-- Imagen de fondo -->
    <div class="absolute inset-0 bg-[url('@/assets/bg_home.webp')] bg-cover bg-center brightness-50"></div>

    <!-- Contenedor con todo el contenido visible del juego -->
    <div class="relative z-10 w-full max-w-3xl flex flex-col gap-8 items-center">

      <!-- Sección de puntuación y vidas -->
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

      <!-- Cargando palabra -->
      <div v-if="cargando" class="flex justify-center items-center min-h-[200px] w-full">
        <div class="flex flex-wrap justify-center gap-4 bg-purple-200 p-6 rounded-2xl shadow-inner w-full animate-pulse">
          <div v-for="n in 5" :key="n" class="bg-purple-500 opacity-40 h-20 w-20 rounded-2xl"></div>
        </div>
      </div>

      <div v-else class="w-full flex flex-col gap-8 items-center">
        <!-- Letras que el usuario debe ordenar -->
        <div class="flex flex-wrap justify-center gap-4 bg-purple-400 p-6 rounded-2xl shadow-inner w-full">
          <button 
            v-for="(letra, i) in letrasDesordenadas" 
            :key="i" 
            @click="elegirLetra(i)"
            :disabled="letrasElegidas.includes(i)"
            class="bg-purple-800 text-white text-4xl uppercase px-6 py-4 rounded-2xl hover:bg-purple-700 disabled:opacity-40 transition shadow-md min-w-[70px] cursor-pointer">
            {{ letra }}
          </button>
        </div>

        <!-- Letras seleccionadas por el usuario -->
        <div class="flex justify-center gap-4 text-4xl font-extrabold font-mono tracking-widest">
          <span 
            v-for="(letra, i) in palabraUsuario" 
            :key="'letra' + i"
            class="uppercase border-b-4 border-blue-300 pb-2 w-12 text-center font-semibold">
            {{ letra }}
          </span>
        </div>

        <!-- Botones para borrar o pasar palabra -->
        <div class="flex flex-wrap justify-center gap-10">
          <button 
            @click="borrarIntento"
            class="bg-amber-600 hover:bg-amber-900 text-stone-200 text-2xl font-semibold px-6 h-18 rounded-xl transition min-w-[160px] shadow-md cursor-pointer">
            Borrar intento
          </button>
          <button 
            @click="siguientePalabra"
            class="bg-rose-600 hover:bg-rose-900 text-stone-200 text-2xl font-semibold px-6 h-18 rounded-xl transition min-w-[160px] shadow-md cursor-pointer">
            Siguiente palabra
          </button>
        </div>

        <!-- Mensaje que muestra si ha acertado o fallado -->
        <div 
          v-if="mensaje"
          :class="mensaje.includes('Bien') ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300'"
          class="text-center font-semibold text-xl rounded-xl px-6 py-4 shadow-md min-h-[3.5rem] transition-all duration-300">
          {{ mensaje }}
        </div>
      </div>

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
      palabraSiguiente: '',
      letrasDesordenadas: [],
      palabraUsuario: [],
      letrasElegidas: [],
      mensaje: '',
      puntos: 0,
      vidas: 5,
      cargando: true
    }
  },
  async mounted() {
    this.palabraCorrecta = await this.obtenerPalabraValida()
    this.letrasDesordenadas = this.mezclarLetras(this.palabraCorrecta)
    this.palabraSiguiente = await this.obtenerPalabraValida()
    this.cargando = false
  },
  methods: {
    async obtenerPalabraValida() {
      let palabra = ''
      do {
        const nueva = await getPalabraAleatoria()
        if (nueva.length <= 5) palabra = nueva.toLowerCase()
      } while (!palabra)
      return palabra
    },

    mezclarLetras(palabra) {
      let mezclada
      do {
        mezclada = palabra.split('').sort(() => Math.random() - 0.5)
      } while (mezclada.join('') === palabra)
      return mezclada
    },

    elegirLetra(i) {
      this.palabraUsuario.push(this.letrasDesordenadas[i])
      this.letrasElegidas.push(i)

      if (this.palabraUsuario.length === this.palabraCorrecta.length) {
        const intento = this.palabraUsuario.join('')
        if (intento === this.palabraCorrecta) {
          this.puntos++
          this.mensaje = '¡Bien hecho!'
        } else {
          this.vidas--
          this.mensaje = `¡Fallaste! La palabra era "${this.palabraCorrecta}".`
        }

        setTimeout(async () => {
          if (this.vidas === 0) {
            this.$emit('finJuego', this.puntos)
          } else {
            this.borrarIntento()
            this.palabraCorrecta = this.palabraSiguiente
            this.letrasDesordenadas = this.mezclarLetras(this.palabraCorrecta)
            this.cargando = true
            this.palabraSiguiente = await this.obtenerPalabraValida()
            this.cargando = false
          }
        }, 1500)
      }
    },

    borrarIntento() {
      this.palabraUsuario = []
      this.letrasElegidas = []
      this.mensaje = ''
    },

    async siguientePalabra() {
      this.vidas--
      if (this.vidas === 0) {
        this.$emit('finJuego', this.puntos)
      } else {
        this.borrarIntento()
        this.palabraCorrecta = this.palabraSiguiente
        this.letrasDesordenadas = this.mezclarLetras(this.palabraCorrecta)
        this.cargando = true
        this.palabraSiguiente = await this.obtenerPalabraValida()
        this.cargando = false
      }
    },

    async reiniciarJuego() {
      this.puntos = 0
      this.vidas = 5
      this.cargando = true
      this.palabraCorrecta = await this.obtenerPalabraValida()
      this.letrasDesordenadas = this.mezclarLetras(this.palabraCorrecta)
      this.palabraSiguiente = await this.obtenerPalabraValida()
      this.cargando = false
    }
  }
}
</script>
