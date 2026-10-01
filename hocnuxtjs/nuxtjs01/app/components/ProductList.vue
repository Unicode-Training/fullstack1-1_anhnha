<template>
  <h2 class="text-3xl">Product List</h2>
</template>
<script setup lang="ts">
import { getProductList } from "@/services/product-service";
const { data } = await useAsyncData("product2", getProductList);
console.log(data.value);
</script>
