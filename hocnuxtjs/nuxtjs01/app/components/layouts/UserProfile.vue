<template>
  <ul class="flex items-center gap-3">
    <li v-if="pending">Loading...</li>
    <template v-else-if="!user">
      <li>
        <RouterLink to="/login">Login</RouterLink>
      </li>
      <li>
        <RouterLink to="/register">Register</RouterLink>
      </li>
    </template>
    <template v-else="user">
      <li>Chào: {{ user!.name }}</li>
      <li>Logout</li>
    </template>
  </ul>
</template>
<script lang="ts" setup>
const { data: user, pending } = await useApi<{ name: string }>(`/auth/profile`);

//1. Client -> Nuxt -> Cookie -> Backend
//2. Client -> Api backend -> Nuxt -> Client -> Backend

//Public -> Không cần auth -> Server side
//Private -> Cần auth -> Client side (Cần lấy data từ backend)
</script>
