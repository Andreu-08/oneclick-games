<template>
  <div
    class="bg-white rounded-2xl shadow-xl p-4 flex items-center justify-center gap-4 w-fit transition-transform duration-300 hover:scale-105"
  >
    <!-- Primer icono con su acción -->
    <button
      @click="accionUno"
      class="w-12 h-12 flex items-center justify-center"
    >
      <slot name="icono-uno" />
    </button>

    <!-- Segundo icono con su acción -->
    <button
      @click="accionDos"
      class="w-12 h-12 flex items-center justify-center"
    >
      <slot name="icono-dos" />
    </button>
  </div>
</template>

<script setup>
/**
 * IconosAccion.vue
 *
 * Componente visual reutilizable que agrupa dos botones de acción con iconos PNG.
 * Diseñado para ser coherente con el estilo bento de la aplicación.
 *
 * Props:
 * - accionUno: función que se ejecuta al hacer clic en el primer icono.
 * - accionDos: función que se ejecuta al hacer clic en el segundo icono.
 *
 * Uso esperado: cerrar sesión, mostrar ranking, volver atrás, etc.
 */

defineProps({
  accionUno: {
    type: Function,
    required: true
  },
  accionDos: {
    type: Function,
    required: true
  }
})
</script>
