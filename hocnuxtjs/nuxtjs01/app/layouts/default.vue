<template>
  <header
    class="flex justify-between items-center shadow mx-auto px-5 py-3 max-w-300"
  >
    <span class="font-medium text-3xl">
      <RouterLink to="/"> LOGO </RouterLink>
    </span>
    <nav class="flex items-center gap-3">
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
      <UserProfile />
    </nav>
  </header>
  <main class="mx-auto py-3 max-w-300">
    <slot></slot>
  </main>
</template>
<script setup>
import UserProfile from "~/components/layouts/UserProfile.vue";

useSeoMeta({
  title: "Trang chủ",
  description: "Unicode đào tạo lập trình",
  ogTitle: "Unicode Academy",
});
</script>
