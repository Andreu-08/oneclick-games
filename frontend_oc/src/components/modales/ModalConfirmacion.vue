<template>
  <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
    <div class="bg-green-100 rounded-2xl shadow-xl p-8 w-full max-w-2xl border border-blue-100">

      <!-- Título con iconos -->
      <div class="flex items-center justify-between mb-4">
        <img src="@/assets/icons/confirmar.png" alt="Confirmar" class="w-10 h-10" />
        <h2 class="text-3xl text-blue-900 font-semibold text-center flex-1">
          ¿Confirmar registro?
        </h2>
        <img src="@/assets/icons/confirmar.png" alt="Confirmar" class="w-10 h-10" />
      </div>

      <!-- Mensaje con diseño destacado -->
      <div class=" text-center mb-8">
        <p class="text-lg text-gray-700 leading-relaxed">
          Vas a registrar al usuario:
          <span class="text-blue-700 font-semibold text-2xl">
            {{ nickname }}
          </span><br />
          ¿Deseas continuar?
        </p>
      </div>

      <!-- Botones -->
      <div class="flex justify-center gap-6">
        <button
          @click="$emit('cancelar')"
          class="text-xl bg-red-200 hover:bg-red-300 text-gray-800 px-6 py-2 rounded-full transition cursor-pointer"
        >
          Cancelar
        </button>
        <button
          @click="$emit('confirmar')"
          class="text-xl bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full transition cursor-pointer"
        >
          Aceptar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalConfirmacion',
  props: {
    nickname: {
      type: String,
      required: true
    }
  }
}
</script>
