<template>
  <h1 class="text-3xl mb-3">Products</h1>
  <div class="grid grid-cols-4 gap-5">
    <div v-for="product in products">
      <img :src="product.thumbnail" alt="" class="block mb-3" />
      <h2 class="text-xl">
        <RouterLink :to="{ name: 'products-id', params: { id: product.id } }">{{
          product.title
        }}</RouterLink>
      </h2>
      <p>{{ product.price.toLocaleString() }}đ</p>
    </div>
  </div>
</template>
<script setup>
const route = useRoute();
const config = useRuntimeConfig();
const { data: products } = await useFetch(
  `${config.public.apiServer}/products`,
  {
    transform: (data) => data.products,
  },
);
</script>
