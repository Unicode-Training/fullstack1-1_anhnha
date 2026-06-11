<template>
  <h1 class="text-3xl">Product Index</h1>
  <RouterLink
    v-if="can('products.create')"
    :to="{ name: 'admin.products.create' }"
    class="px-3 py-1 bg-green-600"
    >Add Product</RouterLink
  >
</template>
<script setup lang="ts">
import { axiosInstance } from "../../../libs/axios";
import { useAuthStore } from "../../../store/authStore";

const getProducts = async () => {
  const response = await axiosInstance.get("/admin/products");
  console.log(response.data);
};
getProducts();
const { can } = useAuthStore();
</script>
