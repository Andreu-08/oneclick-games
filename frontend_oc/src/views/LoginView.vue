<script setup>
import { ref } from 'vue'
import { useUserStore } from '@/stores/user'

const email = ref('')
const password = ref('')
const userStore = useUserStore()

const login = () => {
  userStore.login(email.value, password.value)
}
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen p-4">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <input v-model="email" placeholder="Email" class="mb-2 p-2 border rounded" />
    <input v-model="password" placeholder="Password" type="password" class="mb-2 p-2 border rounded" />
    <button @click="login" class="bg-blue-600 text-white px-4 py-2 rounded">Entrar</button>
  </div>
</template>
