<script setup>
import { ref, onMounted } from 'vue';

// Reactive state for our data
const projects = ref([]);
const isLoading = ref(true);

// Fetch data when the component is first mounted
onMounted(async () => {
  try {
    const response = await fetch('http://localhost:8000/api/projects');
    projects.value = await response.json();
  } catch (error) {
    console.error("Failed to fetch projects:", error);
  } finally {
    isLoading.value = false;
  }
});
</script>

<template>
  <div class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-12">
      <h1 class="text-4xl font-bold text-center mb-8">Community Projects</h1>
      
      <div v-if="isLoading" class="text-center py-10">Loading projects...</div>
      
      <div v-else class="space-y-6">
        <div v-for="project in projects" :key="project.id" class="bg-white p-6 rounded-lg shadow-md">
          <h2 class="text-2xl font-bold mb-2">{{ project.title }}</h2>
          <p class="text-gray-700 mb-4">{{ project.description }}</p>
          <a v-if="project.github_url" :href="project.github_url" target="_blank" rel="noopener noreferrer" class="text-blue-600 font-semibold hover:underline">
            View on GitHub &rarr;
          </a>
          <span v-else class="text-gray-500">
            Code link coming soon
          </span>
        </div>
      </div>
    </div>
  </div>
</template>