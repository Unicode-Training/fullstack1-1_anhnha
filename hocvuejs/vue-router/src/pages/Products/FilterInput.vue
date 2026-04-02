<template>
  <input
    type="search"
    class="w-full border border-[#ddd] py-1 px-3 mb-3 outline-0"
    placeholder="Từ khóa..."
    @input="handleSearch"
    :value="$route.query.s"
  />
</template>
<script setup lang="ts">
import { useRouter } from "vue-router";
import "../../utils/utils";
import { debounce } from "../../utils/utils";
const router = useRouter();
const handleSearch = debounce((e: InputEvent) => {
  const value = (e.target as HTMLInputElement)?.value;
  router.push({
    name: "products.index",
    query: {
      s: value,
    },
  });
});

//debouce --> kỹ thuật delay function
// setTimeout, clearTimeout
</script>
