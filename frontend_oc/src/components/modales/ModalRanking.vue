<template>
  <div class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-2xl border border-blue-100">
      
      <!-- Título -->
      <div class="flex items-center justify-between mb-4">
        <img src="@/assets/icons/top10.png" alt="Ranking" class="w-12 h-12" />
        <h2 class="text-3xl text-blue-900 text-center flex-1 font-semibold">
          {{ title }}
        </h2>
        <img src="@/assets/icons/top10.png" alt="Ranking" class="w-12 h-12" />
      </div>

      <!-- Usuario logeado -->
      <div
        v-if="userInfo && !cargando"
        class="flex justify-between items-center px-4 py-3 rounded-xl bg-green-100 text-green-900 border border-green-400 mb-4"
      >
        <span class="flex items-center gap-2">
          <img src="@/assets/icons/user.png" alt="Usuario" class="w-5 h-5" />
          {{ userInfo?.nickname?.toUpperCase?.() || 'Usuario' }}
        </span>
        <span>{{ userInfo.total_score }} pts</span>
      </div>

      <!-- Lista o skeleton -->
      <SkeletonRanking v-if="cargando" />
      <ul v-else class="flex flex-col gap-2">
        <li
          v-for="(entry, index) in ranking"
          :key="entry.id"
          :class="[
            'flex justify-between items-center px-4 py-3 rounded-xl',
            entry.id === userId
              ? 'bg-blue-100 text-blue-900 font-semibold border border-blue-300'
              : 'bg-fuchsia-50 text-blue-800'
          ]"
        >
          <span>#{{ index + 1 }} - {{ entry.nickname.toUpperCase() }}</span>
          <span>{{ entry.total_score }} pts</span>
        </li>
      </ul>

      <!-- Botón cerrar -->
      <div class="mt-5 text-center">
        <button
          @click="$emit('close')"
          class="w-full max-w-[200px] py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700"
        >
          Cerrar
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import SkeletonRanking from '@/components/skeletons/SkeletonRanking.vue'

export default {
  name: 'ModalRanking',
  components: {
    SkeletonRanking
  },
  props: {
    ranking: Array,
    userId: Number,
    userInfo: Object,
    cargando: Boolean,
    title: {
      type: String,
      default: 'Top 10'
    }
  }
}
</script>
