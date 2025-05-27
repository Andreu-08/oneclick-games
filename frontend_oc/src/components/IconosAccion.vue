<template>
  <div class="bg-white rounded-2xl shadow-xl p-4 flex items-center justify-center gap-4 w-fit">
    <!-- Primer icono con su acción -->
    <button
      @click="accionUno"
      class="w-12 h-12 flex items-center justify-center hover:scale-105 transition"
    >
      <slot name="icono-uno" />
    </button>

    <!-- Segundo icono con su acción -->
    <button
      @click="accionDos"
      class="w-12 h-12 flex items-center justify-center hover:scale-105 transition"
    >
      <slot name="icono-dos" />
    </button>
  </div>
</template>

<script>
export default {
  name: 'IconosAccion',
  props: {
    accionUno: {
      type: Function,
      required: true
    },
    accionDos: {
      type: Function,
      required: true
    }
  }
}
</script>
