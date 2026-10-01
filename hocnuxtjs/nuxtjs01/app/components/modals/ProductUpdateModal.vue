<template>
  <div v-if="open">
    <div
      class="top-[5%] right-0 left-0 z-50 fixed bg-white mx-auto p-5 border border-gray-300 rounded-xl max-w-110"
    >
      <div
        class="flex justify-between items-center mb-3 pb-3 border-gray-300 border-b"
      >
        <h2 class="text-lg">Title</h2>
        <span
          class="font-semibold text-xl cursor-pointer"
          @click="emit('close')"
          >&times;</span
        >
      </div>
      <div class="py-3">
        <form @submit.prevent="handleSave">
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
          <button
            class="bg-green-600 px-5 py-1 rounded-xl text-white cursor-pointer"
          >
            Add
          </button>
        </form>
      </div>
    </div>
    <div class="z-40 fixed inset-0 bg-black/70" @click="emit('close')"></div>
  </div>
</template>
<script setup lang="ts">
import { CACHE_KEYS } from "~/constants/cache.constant";
import { getProduct, updateProduct } from "~/services/product-crud-service";

const props = defineProps(["open", "id"]);
const emit = defineEmits(["close"]);

const form = ref({
  name: "",
  price: 0,
  description: "",
});

onMounted(() => {
  document.addEventListener("keyup", (e) => {
    if (e.key === "Escape") {
      emit("close");
    }
  });
});

const { data } = await useAsyncData(
  CACHE_KEYS.PRODUCT.DETAIL(props.id),
  async () => {
    const res = await getProduct(props.id);
    return res;
  },
);

watch(
  data,
  () => {
    console.log("watch");

    form.value = {
      name: data.value?.name!,
      price: data.value?.price!,
      description: data.value?.description!,
    };
  },
  {
    immediate: true,
  },
);

const handleSave = async () => {
  try {
    await updateProduct(form.value, props.id);
    emit("close");
    refreshNuxtData(CACHE_KEYS.PRODUCT.DETAIL(props.id));
    refreshNuxtData(CACHE_KEYS.PRODUCT.LIST);
  } catch {}
};
</script>
