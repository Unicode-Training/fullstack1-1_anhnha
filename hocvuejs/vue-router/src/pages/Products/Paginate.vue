<template>
  <div class="flex gap-2">
    <button
      class="bg-green-800 text-white px-3 py-1 cursor-pointer"
      :class="{
        'bg-red-700': +props.page === page,
      }"
      v-for="page in props.totalPage"
      @click="
        $router.push({
          name: 'products.index',
          query: {
            ...$route.query,
            page: page,
          },
        })
      "
    >
      {{ page }}
    </button>
  </div>
</template>
<script setup lang="ts">
const props = defineProps(["page", "totalPage"]);

//nullish (??)
</script>
