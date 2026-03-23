<template>
  <h1>Count: {{ count }}</h1>
  <button @click="count++">+</button>
</template>
<script setup lang="ts">
import { ref, onMounted, onUpdated, onUnmounted } from "vue";

const count = ref(0);

onMounted(() => {
  console.log(`Mounted`);
});

onUpdated(() => {
  console.log(`Updating`);
});

onUnmounted(() => {
  console.log(`Unmounted`);
});
</script>
