<template>
  <h1 class="mb-3 text-3xl">useAsyncData</h1>
  <ProductList />
</template>
<script setup lang="ts">
import ProductList from "../../components/ProductList.vue";
import { getProductList } from "../../services/product-service.js";
const { data } = await useAsyncData("product2", getProductList);
console.log(data.value);
</script>
