<template>
  <ul class="flex items-center gap-3">
    <template v-if="!user">
      <li>
        <RouterLink to="/login">Login</RouterLink>
      </li>
      <li>
        <RouterLink to="/register">Register</RouterLink>
      </li>
    </template>
    <template v-else>
      <li>Chào: {{ user.name }}</li>
      <li>Logout</li>
    </template>
  </ul>
</template>
<script lang="ts" setup>
import { getAccessToken, getRefreshToken, saveToken } from "~~/utils/utils";

const { user } = await useApi();

//1. Client -> Nuxt -> Cookie -> Backend
//2. Client -> Api backend -> Nuxt -> Client -> Backend
</script>
