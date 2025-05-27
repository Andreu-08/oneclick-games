<template>
  <div class="col-span-2 bg-blue-100 rounded-2xl shadow-xl p-6 min-h-[200px] flex flex-col items-center justify-center gap-4">

    <!-- Botones con números -->
    <div class="grid grid-cols-5 gap-2 w-full">
      <button
        v-for="numero in numeros"
        :key="numero"
        class="bg-white text-lg font-semibold px-4 py-2 rounded-xl shadow hover:scale-110 transition cursor-pointer"
        @click="$emit('numero', numero)"
      >
        {{ numero }}
      </button>
    </div>

    <!-- Botón borrar -->
    <button
      class="mt-2 bg-red-200 text-lg font-semibold px-6 py-2 rounded-xl shadow hover:scale-110 transition cursor-pointer"
      @click="$emit('borrar')"
    >
      ←
    </button>

  </div>
</template>

<script>
export default {
  name: 'TecladoNumerico',
  props: {
    numeros: {
      type: Array,
      required: true
    }
  }
}
</script>
