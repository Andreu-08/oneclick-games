<template>
  <article
    class="flex flex-col gap-4 p-5 rounded-2xl shadow-md w-full max-w-[400px] mx-auto animate-pulse"
    style="background-color: #FEF9C2"
  >
    <!-- Título -->
    <div class="bg-blue-100 rounded-xl h-8 w-3/4 mx-auto"></div>

    <!-- Imagen -->
    <div class="bg-gray-300 rounded-xl h-[180px] w-full"></div>

    <!-- Descripción -->
    <div class="bg-purple-200 rounded-xl h-[84px] w-full"></div>

    <!-- Botón -->
    <div class="bg-green-100 rounded-xl h-[84px] flex items-center justify-center">
      <div class="bg-blue-400 rounded-full h-12 w-3/4"></div>
    </div>
  </article>
</template>

<script>
export default {
  name: 'SkeletonCard'
}
</script>
