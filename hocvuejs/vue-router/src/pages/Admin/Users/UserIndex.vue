<template>
  <h1 class="text-3xl">User Index</h1>
  <RouterLink
    v-if="can('users.create')"
    :to="{ name: 'admin.users.create' }"
    class="px-3 py-1 bg-green-600"
    >Add User</RouterLink
  >
</template>
<script setup lang="ts">
import { useAuthStore } from "../../../store/authStore";
const { can } = useAuthStore();
</script>
