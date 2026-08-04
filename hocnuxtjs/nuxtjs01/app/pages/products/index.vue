<template>
  <h1 class="text-3xl mb-3">Products</h1>
  <input
    type="search"
    class="px-3 py-1 outline-none border border-[#ddd] rounded-md w-full"
    placeholder="Search..."
    @input="handleInputSearch"
  />
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
  <div class="flex gap-2 mt-3">
    <button
      class="px-3 py-1 bg-green-600 text-white"
      :class="{
        'bg-red-600': +(route.query.page ?? 1) === page,
      }"
      v-for="page in maxPage"
      @click="handleChangePage(page)"
    >
      {{ page }}
    </button>
  </div>
</template>
<script setup lang="ts">
import { debounce } from "../../../utils/utils";
const LIMIT = 12;
const router = useRouter();
const route = useRoute();
const config = useRuntimeConfig();
const maxPage = useState("product-max-page", () => 0);
const handleInputSearch = debounce((e: Event) => {
  const target = e.target as HTMLInputElement;
  const value = target.value;
  router.push({
    query: {
      q: value,
    },
  });
});
type Product = {
  id: number;
  price: number;
  title: string;
  thumbnail: string;
};
const searchInput = computed(() => route.query.q ?? "");
const skip = computed(() => {
  const page = route.query.page ?? 1;
  return (+page - 1) * LIMIT;
});
const { data: products, refresh } = await useFetch(
  `${config.public.apiServer}/products/search`,
  {
    transform: (data: { products: Product[]; total: number }) => {
      maxPage.value = Math.ceil(data.total / LIMIT);
      return data.products;
    },
    query: {
      q: searchInput,
      limit: LIMIT,
      skip: skip,
    },
    watch: [() => route.query.q, () => route.query.page],
  },
);

const handleChangePage = (page: number) => {
  router.push({
    query: {
      ...route.query,
      page,
    },
  });
};
</script>
