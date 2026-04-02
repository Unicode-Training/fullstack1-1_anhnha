<template>
  <Header></Header>
  <main class="max-w-[80%] mx-auto">
    <RouterView></RouterView>
  </main>
</template>
<script setup lang="ts">
import { onMounted } from "vue";
import Header from "./components/Header.vue";
import { useAuthStore } from "./store/authStore";
const authStore = useAuthStore();
onMounted(() => {
  authStore.profile();
});
</script>
