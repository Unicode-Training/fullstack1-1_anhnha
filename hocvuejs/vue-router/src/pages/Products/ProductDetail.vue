<template>
  <h2 v-if="isLoading">Loading...</h2>
  <h2 v-else-if="error">{{ error }}</h2>
  <template v-else>
    <h1 class="text-xl">{{ product.name }}</h1>
    <p class="text-lg">{{ product.price }}</p>
    <p>{{ product.description }}</p>
  </template>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import type { Product } from "../../types/product.type";
import { AxiosError } from "axios";
import { axiosInstance } from "../../libs/axios";
const route = useRoute();
const router = useRouter();
const product = ref<Product>({} as Product);
const error = ref();
const isLoading = ref(true);
const getProduct = async () => {
  const id = route.params.productId;
  try {
    const response = await axiosInstance.get(`/products/${id}`);
    const { data } = response.data;
    product.value = data;
  } catch (err) {
    if (err instanceof AxiosError) {
      if (err.status === 404) {
        return router.push(`/404`);
      }
      error.value = err.message;
    }
  } finally {
    isLoading.value = false;
  }
};
getProduct();
</script>
