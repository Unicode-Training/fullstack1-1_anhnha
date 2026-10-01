<template>
  <ModalProvider>
    <ProductDetail />
  </ModalProvider>
</template>
<script setup lang="ts">
import ModalProvider from "~/components/crud-products/ModalProvider.vue";
import ProductDetail from "~/components/crud-products/ProductDetail.vue";
</script>
