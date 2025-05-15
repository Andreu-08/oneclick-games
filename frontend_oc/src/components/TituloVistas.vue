<template>
  <div class="flex flex-col items-center gap-4">
    <div class="bg-blue-100 rounded-2xl shadow-xl px-8 py-6 w-full flex justify-center">
      <h1 class="text-4xl md:text-6xl font-extrabold text-center text-slate-800 drop-shadow-2xl tracking-wide">
        {{ titulo }}
      </h1>
    </div>
  </div>
</template>

<script setup>
/**
 * TituloVistas.vue
 * Componente reutilizable para mostrar títulos principales en vistas como Login, Juegos, Ranking, etc.
 * 
 * Props:
 * - titulo: String (obligatoria) → texto del título a mostrar.
 */

defineProps({
  titulo: {
    type: String,
    required: true
  }
})
</script>
