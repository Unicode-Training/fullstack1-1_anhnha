<template>
  <h1 class="text-3xl">Demo</h1>
  <h2 class="text-2xl" v-if="loading">Loading...</h2>
  <ul v-else>
    <li v-for="item in data.products">{{ item.title }}</li>
  </ul>
</template>
<script setup lang="ts">
const { data, loading } = useFetch2(`https://dummyjson.com/products`);
</script>
