<template>
  <h2>Danh sách sản phẩm</h2>
  <ul>
    <li v-for="product in products" :key="product.id" class="py-3">
      {{ product.name }} - {{ product.price }} -
      <button @click="openModal(product.id.toString())">Edit</button>
      <RouterLink :to="'/crud-products/' + product.id">View</RouterLink>
    </li>
  </ul>
</template>
<script setup lang="ts">
import { CACHE_KEYS } from "~/constants/cache.constant";
import { getProductList } from "~/services/product-crud-service";
const { data: products } = await useAsyncData(
  CACHE_KEYS.PRODUCT.LIST,
  getProductList,
);
import { ref, type Ref } from "vue";
const modalStatus = inject<Ref<boolean>>("modalStatus");
const idUpdate = inject<Ref<number>>("idUpdate");
const openModal = (id: string) => {
  if (!modalStatus || !idUpdate) {
    return;
  }
  modalStatus.value = true;
  idUpdate.value = +id;
};
</script>
