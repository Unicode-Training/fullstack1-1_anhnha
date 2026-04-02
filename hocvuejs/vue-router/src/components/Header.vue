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
        <span v-else-if="authStore.isAuthenticated">
          Chào, {{ authStore.user?.name }}
        </span>
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
import { useAuthStore } from "../store/authStore";
const authStore = useAuthStore();
</script>
