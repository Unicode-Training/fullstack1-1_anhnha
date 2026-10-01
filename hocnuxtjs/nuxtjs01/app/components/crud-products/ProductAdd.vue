<template>
  <form @submit.prevent="handleAdd">
    <div class="mb-3">
      <label for="">Name</label>
      <input
        type="text"
        placeholder="Name..."
        class="px-3 py-1 border border-gray-300 outline-none w-full"
        v-model="form.name"
      />
    </div>
    <div class="mb-3">
      <label for="">Price</label>
      <input
        type="number"
        placeholder="Price..."
        class="px-3 py-1 border border-gray-300 outline-none w-full"
        v-model="form.price"
      />
    </div>
    <div class="mb-3">
      <label for="">Description</label>
      <textarea
        class="px-3 py-1 border border-gray-300 outline-none w-full"
        placeholder="Description"
        v-model="form.description"
      ></textarea>
    </div>
    <button class="bg-green-600 px-5 py-1 rounded-xl text-white cursor-pointer">
      Add
    </button>
  </form>
</template>
<script lang="ts" setup>
import { CACHE_KEYS } from "~/constants/cache.constant";
import { createProduct } from "~/services/product-crud-service";

const form = ref({
  name: "",
  price: 0,
  description: "",
});
const handleAdd = async () => {
  try {
    await createProduct(form.value);
    await refreshNuxtData(CACHE_KEYS.PRODUCT.LIST);
  } catch {
    //Lỗi
  }
};
</script>
