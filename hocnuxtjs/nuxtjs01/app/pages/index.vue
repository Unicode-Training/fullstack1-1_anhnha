<template>
  <h1 class="text-3xl">Home</h1>
  <RouterLink :to="{ name: 'products' }">Products</RouterLink>
  <RouterLink :to="{ name: 'products-best-seller' }"
    >Products Best Seller</RouterLink
  >
  <RouterLink :to="{ name: 'products-id', params: { id: 1 } }"
    >Products 1</RouterLink
  >
  <span> {{ value }}</span>
</template>
<script setup lang="ts">
// const value = helloWorld("abc");
const value = getB();
</script>
