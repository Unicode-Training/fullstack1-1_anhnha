<template>
  <main
    class="flex mx-auto"
    :class="{
      'cursor-ew-resize': isDrag,
    }"
  >
    <aside
      class="group/sidebar w-55 bg-[#ddd] h-screen p-3 relative"
      ref="sidebar"
    >
      <div
        class="absolute top-0 right-0 bottom-0 w-1.5 bg-[#ccc] opacity-0 group-hover/sidebar:opacity-100 cursor-ew-resize"
        :class="{
          'opacity-100': isDrag,
        }"
        @mousedown="handleMousedown"
      ></div>
      <h2>Sidebar</h2>
    </aside>
    <div class="flex-1 p-5">
      <h2>Content</h2>
      <h2 class="text-3xl" v-if="productLoading">Loading...</h2>
      <h2 class="text-3xl" v-else-if="productError">{{ productError }}</h2>
      <div v-else class="flex flex-wrap">
        <div class="max-w-[calc(100%/4)]" v-for="product in productList">
          <div class="h-75 overflow-hidden">
            <img :src="product.thumbnail" alt="" class="block max-w-full" />
          </div>
          <h3>{{ product.title }}</h3>
          <p>{{ product.price }}</p>
        </div>
      </div>
    </div>
  </main>
</template>
<script setup lang="ts">
import { onMounted, onUnmounted, ref } from "vue";

// import { ref } from "vue";
// import Counter from "./components/Counter.vue";
// const isShow = ref(true);
//lifecycle --> theo dõi từng giai đoạn của vòng đời component
// - Mounting: Giai đoạn khởi tạo component (Ngay sau khi cây DOM được hình thành)
// - Updating: Sau lần cập nhật dom thứ nhất
// - Unmounting: Trước khi component bị xóa khỏi dom

//Mounting: Giải quyết bài toán DOM, Call api từ server
//Updating:
//Unmounting: Cleanup dữ liệu không sử dụng
// - timer: setTimeout, setInterval
// - event listener
// ==> memory leak
type Product = {
  title: string;
  thumbnail: string;
  price: number;
};
const sidebar = ref();
const isDrag = ref(false);
const productList = ref<Product[]>([]);
const productLoading = ref(true);
const productError = ref();
const handleMouseMove = (e: MouseEvent) => {
  let x = e.clientX;
  if (x < 180) {
    x = 180;
  }
  if (x > 320) {
    x = 320;
  }
  sidebar.value.style.width = `${x}px`;
};
const handleMousedown = () => {
  document.addEventListener("mousemove", handleMouseMove);
  document.body.classList.add(`select-none`);
  isDrag.value = true;
};
const handleMouseup = () => {
  document.removeEventListener("mousemove", handleMouseMove);
  document.body.classList.remove(`select-none`);
  isDrag.value = false;
};
document.addEventListener("mouseup", handleMouseup);
onUnmounted(() => {
  document.removeEventListener("mouseup", handleMouseup);
});

onMounted(() => {
  const getProducts = async () => {
    try {
      const response = await fetch(`https://dummyjson.com/products`);
      const { products } = await response.json();
      productList.value = products;
    } catch (error) {
      if (error instanceof Error) {
        productError.value = error.message;
      }
    } finally {
      productLoading.value = false;
    }
  };
  getProducts();
});
</script>
