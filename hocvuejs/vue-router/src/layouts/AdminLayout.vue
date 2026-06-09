<template>
  <main class="max-w-[80%] mx-auto flex">
    <div class="w-53">
      <h2 class="text-3xl font-medium">Admin</h2>
      <ul>
        <li><RouterLink to="/admin">Dashboard</RouterLink></li>
        <li><RouterLink to="/admin/users">Users</RouterLink></li>
        <li><RouterLink to="/admin/products">Products</RouterLink></li>
        <li><RouterLink to="/admin/roles">Roles</RouterLink></li>
      </ul>
    </div>
    <div class="flex-1">
      <RouterView></RouterView>
    </div>
  </main>
</template>
<script setup lang="ts">
import { useAuthStore } from "../store/authStore";
const { user } = useAuthStore();
console.log(user);
</script>
