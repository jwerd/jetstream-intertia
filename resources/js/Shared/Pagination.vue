<template>
  <div class="mt-6 -mb-1 flex flex-wrap">
    <template v-for="(link, key) in links">
      <div v-if="link.url === null" :key="key" 
      class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" 
      :class="{ 'ml-auto': link.label === 'Next' }" v-html="link.label">{{ link.label }}</div>
      <inertia-link v-else :key="key" 
      class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-indigo-700 hover:text-white focus:border-indigo-500 focus:text-indigo-500" 
      :class="{ 'bg-indigo-600 text-white': link.active, 'ml-autok': link.label === 'Next' }" :href="link.url" v-html="link.label">{{ link.label }}</inertia-link>
    </template>
  </div>
</template>

<script>
export default {
  props: {
    links: Array,
  }
}
</script>