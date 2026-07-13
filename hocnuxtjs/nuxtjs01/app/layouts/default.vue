<template>
  <header
    class="max-w-300 mx-auto py-3 flex justify-between items-center shadow"
  >
    <span class="text-3xl font-medium">
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
    </ul>
  </header>
  <main class="max-w-300 mx-auto py-3">
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
