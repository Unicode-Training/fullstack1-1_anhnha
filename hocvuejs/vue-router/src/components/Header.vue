<template>
  <header class="flex max-w-[80%] mx-auto py-3 items-center">
    <div>
      <h2 class="text-3xl font-bold">Unicode</h2>
    </div>
    <ul class="flex gap-3 ml-auto">
      <li>
        <RouterLink
          :to="{
            name: 'home',
          }"
          >Home</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'about',
          }"
          >About</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'products.index',
          }"
          >Products</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'contact',
          }"
          >Contact</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'admin.dashboard',
          }"
          >Admin</RouterLink
        >
      </li>
      <li>
        <span v-if="authStore.isLoading">Loading...</span>
        <div v-else-if="authStore.isAuthenticated" class="flex gap-2">
          <span>Chào, {{ authStore.user?.name }}</span>
          <button class="text-red-600 cursor-pointer" @click="handleLogout">
            Đăng xuất
          </button>
        </div>
        <span v-else>
          <RouterLink
            :to="{
              name: 'auth.login',
            }"
            >Login</RouterLink
          >
        </span>
      </li>
    </ul>
  </header>
</template>
<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { useAuthStore } from "../store/authStore";
const authStore = useAuthStore();
const router = useRouter();
const route = useRoute();
const handleLogout = async () => {
  await authStore.logout();
  router.push(route.fullPath);
};
</script>
