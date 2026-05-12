<script setup lang="ts">
import Header from "../components/Header.vue";
</script>

<template>
  <Header></Header>
  <main class="max-w-[80%] mx-auto">
    <RouterView></RouterView>
  </main>
</template>
