<template>
  <div class="min-h-screen bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300">
    <!-- Header / Navbar -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-indigo-800">OneClick Games</h1>
      <nav class="space-x-4">
        <RouterLink to="/" class="text-indigo-600 hover:underline">Inicio</RouterLink>
        <RouterLink to="/login" class="text-purple-600 hover:underline">Login</RouterLink>
      </nav>
    </header>

    <!-- Aquí se renderizan las vistas según la ruta -->
    <main class="p-4">
      <router-view />
    </main>

    <!-- Footer opcional -->
    <footer class="text-center text-sm text-indigo-600 mt-10">
      Versión beta – Proyecto DAW • <a href="https://github.com/Andreu-08/oneclick_games" target="_blank" class="underline hover:text-purple-800">GitHub</a>
    </footer>
  </div>
</template>

<script setup>
// sin lógica aún
</script>
