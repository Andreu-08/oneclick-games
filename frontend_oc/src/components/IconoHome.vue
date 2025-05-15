<template>
  <router-link
    to="/"
    :class="[
      'bg-white rounded-2xl shadow-xl flex items-center justify-center transition-transform duration-300 hover:scale-105',
      padding
    ]"
  >
    <img
      src="@/assets/Logo_oc.png"
      alt="Logo OneClick Games"
      :class="[width, height, 'rounded-full']"
    />
  </router-link>
</template>

<script setup>
/**
 * Componente reutilizable para mostrar el logo de OneClick Games.
 * El tamaño del logo y el padding del contenedor se pueden personalizar mediante props.
 */

defineProps({
  width: {
    type: String,
    default: 'w-40 md:w-60'
  },
  height: {
    type: String,
    default: 'h-40 md:h-60'
  },
  padding: {
    type: String,
    default: 'p-10'
  }
})
</script>
