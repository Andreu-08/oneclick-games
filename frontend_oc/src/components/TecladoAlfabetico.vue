<template>
  <div class="col-span-3 bg-green-100 rounded-2xl shadow-xl p-6 min-h-[200px] flex flex-wrap justify-center gap-2">
    
    <!-- Botones con letras -->
    <button
      v-for="letra in alfabeto"
      :key="letra"
      class="bg-white text-lg font-bold px-4 py-2 rounded-xl shadow hover:scale-110 transition cursor-pointer"
      @click="$emit('tecla', letra)"
    >
      {{ letra }}
    </button>

    <!-- Botón de retroceso -->
    <button
      class="bg-red-200 text-lg font-bold px-4 py-2 rounded-xl shadow hover:scale-110 transition cursor-pointer"
      @click="$emit('retroceso')"
    >
      ←
    </button>

  </div>
</template>

<script>
export default {
  name: 'TecladoAlfabetico',
  props: {
    alfabeto: {
      type: Array,
      required: true
    }
  }
}
</script>
