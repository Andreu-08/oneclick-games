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

      <!-- Letras que el usuario debe ordenar -->
      <div class="flex flex-wrap justify-center gap-4 bg-purple-400 p-6 rounded-2xl shadow-inner w-full">
        <button 
          v-for="(letra, i) in letrasDesordenadas" 
          :key="i" 
          @click="elegirLetra(i)"
          :disabled="letrasElegidas.includes(i)"
          class="bg-purple-800 text-white text-4xl uppercase px-6 py-4 rounded-2xl hover:bg-purple-700 disabled:opacity-40 transition shadow-md min-w-[70px]">
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
          class="bg-amber-400 hover:bg-amber-500 text-white text-lg font-semibold px-6 py-3 rounded-xl transition min-w-[160px] shadow-md">
          Borrar intento
        </button>
        <button 
          @click="siguientePalabra"
          class="bg-rose-500 hover:bg-rose-600 text-white text-lg font-semibold px-6 py-3 rounded-xl transition min-w-[160px] shadow-md">
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
</template>

<script>
import { getPalabraAleatoria } from '@/services/games'

export default {
  name: 'OrdenarPalabrasView',
  emits: ['finJuego'],
  data() {
    return {
      palabraCorrecta: '',        // palabra que hay que adivinar
      letrasDesordenadas: [],     // letras en orden aleatorio
      palabraUsuario: [],         // letras que selecciona el usuario
      letrasElegidas: [],         // índices de letras ya pulsadas
      mensaje: '',                // mensaje que muestra el resultado
      puntos: 0,                  // contador de aciertos
      vidas: 5                    // número de intentos disponibles
    }
  },
  mounted() {
    // cuando se carga el componente se obtiene la primera palabra
    this.cargarPalabra()
  },
  methods: {
    // obtiene una palabra aleatoria válida (máximo 5 letras)
    async cargarPalabra() {
      this.borrarIntento()
      try {
        let palabra = ''
        do {
          const nueva = await getPalabraAleatoria()
          if (nueva.length <= 5) palabra = nueva.toLowerCase()
        } while (!palabra)

        this.palabraCorrecta = palabra
        this.letrasDesordenadas = palabra.split('').sort(() => Math.random() - 0.5)
      } catch (e) {
        this.mensaje = 'No se pudo cargar la palabra'
      }
    },

    // guarda la letra seleccionada por el usuario
    elegirLetra(i) {
      this.palabraUsuario.push(this.letrasDesordenadas[i])
      this.letrasElegidas.push(i)

      // si ya ha seleccionado todas las letras, se comprueba el resultado
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

    // limpia el intento actual (para probar de nuevo)
    borrarIntento() {
      this.palabraUsuario = []
      this.letrasElegidas = []
      this.mensaje = ''
    },

    // cambia a otra palabra y quita una vida
    siguientePalabra() {
      this.vidas--
      if (this.vidas === 0) {
        this.$emit('finJuego', this.puntos)
      } else {
        this.cargarPalabra()
      }
    },

    // reinicia el juego completo (para volver a jugar)
    reiniciarJuego() {
      this.puntos = 0
      this.vidas = 5
      this.cargarPalabra()
    }
  }
}
</script>
