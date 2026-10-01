<template>
  <ModalProvider>
    <h1 class="mb-3 text-3xl">Product CRUD</h1>
    <ProductList />
    <ProductAdd />
  </ModalProvider>
</template>
<script setup lang="ts">
import ModalProvider from "~/components/crud-products/ModalProvider.vue";
import ProductAdd from "~/components/crud-products/ProductAdd.vue";
import ProductList from "~/components/crud-products/ProductList.vue";
</script>
