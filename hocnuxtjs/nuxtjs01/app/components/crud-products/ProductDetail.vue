<template>
  <h1 class="text-3xl">{{ product?.name }}</h1>
  <p>Price: {{ product?.price }}</p>
  <p>Description: {{ product?.description }}</p>
  <button
    class="bg-green-600 px-3 py-1 text-white cursor-pointer"
    @click="openModal"
  >
    Update
  </button>
</template>
<script lang="ts" setup>
import { CACHE_KEYS } from "~/constants/cache.constant";
import { getProduct } from "~/services/product-crud-service";

const route = useRoute();
const { id } = route.params;

const { data: product } = await useAsyncData(
  CACHE_KEYS.PRODUCT.DETAIL(id as string),
  () => getProduct(id as string),
);

import { inject, type Ref } from "vue";
const modalStatus = inject<Ref<boolean>>("modalStatus");
const idUpdate = inject<Ref<number>>("idUpdate");

const openModal = () => {
  if (!modalStatus || !idUpdate) {
    return;
  }
  modalStatus.value = true;
  idUpdate.value = Number(id);
};
</script>
