<template>
  <div class="grid grid-cols-2">
    <div>
      <img :src="image" class="w-full block mb-3" />
      <div class="flex">
        <img
          width="100"
          height="100"
          v-for="image in product.images"
          :src="image"
          alt=""
          @click="handleChangeImage(image)"
        />
      </div>
    </div>
    <div>
      <h1 class="text-3xl">{{ product.title }}</h1>
    </div>
  </div>
</template>
<script setup>
const route = useRoute();
const config = useRuntimeConfig();
const { data: product } = await useFetch(
  `${config.public.apiServer}/products/${route.params.id}`,
);
const image = ref(product.value.thumbnail);
const handleChangeImage = (url) => {
  image.value = url;
};
</script>
