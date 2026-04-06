<template>
  <h1 class="text-3xl mb-3">Products</h1>
  <RouterLink
    v-if="authStore.isAuthenticated"
    :to="{
      name: 'products.create',
    }"
    class="bg-green-700 text-white px-3 py-2 rounded-lg cursor-pointer mb-3 inline-block"
    >Thêm mới</RouterLink
  >
  <FilterInput />
  <span class="block" v-if="message">{{ message }}</span>
  <div class="flex flex-wrap -mx-2.5">
    <h2 v-if="isLoading">Loading...</h2>
    <h2 v-else-if="error">{{ error }}</h2>
    <div v-else v-for="product in products" class="w-1/4 px-2.5 mb-5">
      <div class="border border-[#ddd] p-3">
        <h2 class="text-xl font-medium">{{ product.name }}</h2>
        <p class="text-lg">{{ product.price }}</p>
        <div class="flex gap-1">
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
          <RouterLink
            v-if="authStore.isAuthenticated"
            :to="{
              name: 'products.update',
              params: {
                productId: product.id,
              },
            }"
            >Sửa</RouterLink
          >
          <span
            v-if="authStore.isAuthenticated"
            class="cursor-pointer text-red-700"
            @click="handleDelete(product.id!)"
            >Xóa</span
          >
        </div>
      </div>
    </div>
  </div>
  <Paginate :page="$route.query.page ?? 1" :totalPage="totalPage" />
</template>
<script setup lang="ts">
/*
width = 100% / column - gap + gap / column
*/
import { ref, watch } from "vue";
const products = ref<Product[]>([]);
const error = ref();
const isLoading = ref(true);
const totalPage = ref(0);
const message = ref("");
const route = useRoute();
const router = useRouter();
const authStore = useAuthStore();
import { axiosInstance } from "../../libs/axios";
import type { Product } from "../../types/product.type";
import { AxiosError } from "axios";
import { RouterLink, useRoute, useRouter } from "vue-router";
import FilterInput from "./FilterInput.vue";
import Paginate from "./Paginate.vue";
import { useAuthStore } from "../../store/authStore";
const LIMIT = 3;
const getProducts = async () => {
  try {
    const response = await axiosInstance.get(
      `/products?s=${route.query.s ?? ""}&limit=${LIMIT}&page=${route.query.page ?? 1}`,
    );
    const { data } = response.data;
    products.value = data.data;
    totalPage.value = Math.ceil(data.total / LIMIT);
  } catch (err) {
    if (err instanceof AxiosError) {
      error.value = err.message;
    }
  } finally {
    isLoading.value = false;
  }
};

const handleDelete = async (productId: number) => {
  if (!confirm("Bạn có chắc chắn?")) {
    return;
  }
  try {
    await axiosInstance.delete(`/products/${productId}`);
    message.value = "Đã xóa thành công";

    //Xử lý nếu trang cuối còn 1 sản phẩm -> Lùi về 1 trang

    if (products.value.length === 1) {
      const page = route.query.page;
      router.push({
        name: "products.index",
        query: {
          page: +page! - 1,
        },
      });
    }

    getProducts();
  } catch {
    message.value = "Không thể xóa lúc này";
  }
};

getProducts();

watch(
  () => route.query.s,
  () => {
    getProducts();
  },
  {
    immediate: true,
  },
);

watch(
  () => route.query.page,
  () => {
    getProducts();
  },
  {
    immediate: true,
  },
);

//Search từ iphone
//i --> ok
//ip --> Mạng chậm
//iph --> nhanh
//ipho --> nhanh
//iphon --> nhanh
//iphone --> nhanh

//Buổi sau:

//Auth JWT, Redis
</script>
