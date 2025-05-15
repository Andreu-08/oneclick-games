import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import LoginView from '@/views/LoginView.vue'
import GamesView from '@/views/GamesView.vue'
import { useUserStore } from '@/stores/user'

// Definición de rutas
const routes = [
  { path: '/', name: 'home', component: HomeView },
  { path: '/login', name: 'login', component: LoginView },
  {
    path: '/games',
    name: 'games',
    component: GamesView,
    meta: { requiresAuth: true } // Esta ruta requiere autenticación
  }
]

// Configuración del router con historial HTML5
const router = createRouter({
  history: createWebHistory(),
  routes
})

// Guard global de navegación para proteger rutas con meta.requiresAuth
router.beforeEach((to, from, next) => {
  const userStore = useUserStore()

  if (to.meta.requiresAuth && !userStore.isAuthenticated) {
    next('/login')
  } else {
    next()
  }
})

export default router
