<template>
  <header
    class="flex justify-between items-center shadow mx-auto py-3 max-w-300"
  >
    <span class="font-medium text-3xl">
      <RouterLink to="/"> LOGO </RouterLink>
    </span>
    <ul class="flex items-center gap-3">
      <li>
        <RouterLink to="/">Home</RouterLink>
      </li>
      <li>
        <RouterLink to="/about">About</RouterLink>
      </li>
      <li>
        <RouterLink to="/products">Products</RouterLink>
      </li>
      <li>
        <RouterLink to="/products/index2">Products 2</RouterLink>
      </li>
    </ul>
  </header>
  <main class="mx-auto py-3 max-w-300">
    <slot></slot>
  </main>
</template>
<script setup>
useSeoMeta({
  title: "Trang chủ",
  description: "Unicode đào tạo lập trình",
  ogTitle: "Unicode Academy",
});
</script>
