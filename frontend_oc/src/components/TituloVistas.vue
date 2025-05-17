<template>
  <div class="h-32 w-full flex items-center justify-center">
    <div class="bg-blue-100 rounded-2xl shadow-xl px-10 w-full flex items-center justify-center h-full">
      <h1 class="text-4xl md:text-6xl font-extrabold text-center text-slate-800 tracking-wide max-w-[90%] leading-tight">
        {{ titulo }}
      </h1>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TituloVistas',
  props: {
    titulo: {
      type: String,
      required: true
    }
  }
}
</script>
