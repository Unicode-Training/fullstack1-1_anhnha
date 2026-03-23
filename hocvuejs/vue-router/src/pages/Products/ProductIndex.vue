<template>
  <h1>Products</h1>
  <div class="flex flex-wrap -mx-2.5">
    <h2 v-if="isLoading">Loading...</h2>
    <h2 v-else-if="error">{{ error }}</h2>
    <div v-else v-for="product in products" class="w-1/4 px-2.5 mb-5">
      <div class="border border-[#ddd] p-3">
        <h2 class="text-xl font-medium">{{ product.name }}</h2>
        <p class="text-lg">{{ product.price }}</p>
        <RouterLink
          :to="{
            name: 'products.detail',
            params: {
              productId: product.id,
            },
          }"
        >
          Chi tiết
        </RouterLink>
      </div>
    </div>
  </div>
</template>
<script setup lang="ts">
/*
width = 100% / column - gap + gap / column
*/
import { ref } from "vue";
const products = ref<Product[]>([]);
const error = ref();
const isLoading = ref(true);
import { axiosInstance } from "../../libs/axios";
import type { Product } from "../../types/product.type";
import { AxiosError } from "axios";
import { RouterLink } from "vue-router";
const getProducts = async () => {
  try {
    const response = await axiosInstance.get(`/products`);
    const { data } = response.data;
    products.value = data;
  } catch (err) {
    if (err instanceof AxiosError) {
      error.value = err.message;
    }
  } finally {
    isLoading.value = false;
  }
};
getProducts();
</script>
