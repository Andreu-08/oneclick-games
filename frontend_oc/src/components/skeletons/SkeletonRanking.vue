<template>
  <ul class="flex flex-col gap-2">
    <li v-for="n in 10" :key="n" class="animate-pulse px-4 py-3 rounded-xl bg-fuchsia-100 flex justify-between items-center">
      <div class="h-4 bg-fuchsia-300 rounded w-2/3"></div>
      <div class="h-4 bg-fuchsia-300 rounded w-16"></div>
    </li>
  </ul>
</template>

<script>
export default {
  name: 'SkeletonRanking'
}
</script>