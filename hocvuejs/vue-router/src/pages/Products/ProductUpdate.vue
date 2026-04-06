<template>
  <h1 class="text-3xl mb-3">Sửa sản phẩm</h1>
  <form @submit.prevent="handleAdd">
    <div class="flex gap-5 mb-3">
      <div class="mb-3 w-1/2">
        <input
          type="text"
          class="border border-[#ddd] px-3 py-1 outline-none w-full"
          placeholder="Tên..."
          v-model="form.name"
        />
        <span class="text-red-700" v-if="errors.name">{{ errors.name }}</span>
      </div>
      <div class="mb-3 w-1/2">
        <input
          type="number"
          class="border border-[#ddd] px-3 py-1 outline-none w-full"
          placeholder="Giá..."
          v-model="form.price"
        />
        <span class="text-red-700" v-if="errors.price">{{ errors.price }}</span>
      </div>
    </div>
    <div>
      <textarea
        class="border border-[#ddd] px-3 py-1 outline-none w-full h-25"
        placeholder="Mô tả sản phẩm..."
        v-model="form.description"
      ></textarea>
      <span class="text-red-700" v-if="errors.description">{{
        errors.description
      }}</span>
    </div>
    <button class="px-3 py-2 bg-green-600 text-white rounded-md">Lưu</button>
    <span class="block" v-if="message">{{ message }}</span>
  </form>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { axiosInstance } from "../../libs/axios";
import type { Product, ValidateError } from "../../types/product.type";
import { AxiosError } from "axios";
import { useRoute, useRouter } from "vue-router";
const form = ref<Product>({} as Product);
const errors = ref<ValidateError>({});
const message = ref<string>("");
const router = useRouter();
const route = useRoute();
const productId = route.params.productId;
const handleAdd = async () => {
  errors.value = {};
  if (!form.value.name) {
    errors.value.name = "Vui lòng nhập tên";
  }
  if (!form.value.price) {
    errors.value.price = "Vui lòng nhập giá";
  }
  if (!form.value.description) {
    errors.value.description = "Vui lòng nhập mô tả";
  }

  if (!Object.keys(errors.value).length) {
    const status = await updateProduct(form.value);
    if (status) {
      message.value = "Update thành công";
    }
  }
};
const updateProduct = async (productData: Product) => {
  try {
    return await axiosInstance.patch(`/products/${productId}`, productData);
  } catch (error) {
    if (error instanceof AxiosError) {
      message.value = error.message;
      return false;
    }
  }
};

const getProduct = async () => {
  try {
    const response = await axiosInstance.get(`/products/${productId}`);
    const { data } = response.data;
    form.value = {
      name: data.name,
      price: data.price,
      description: data.description,
    };
  } catch (error) {
    if (error instanceof AxiosError) {
      router.push({
        name: "not-found",
      });
    }
  }
};
getProduct();
</script>
