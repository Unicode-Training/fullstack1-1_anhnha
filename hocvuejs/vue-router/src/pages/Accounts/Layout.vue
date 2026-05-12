<script setup lang="ts">
import { RouterLink } from "vue-router";
</script>

<template>
  <div class="flex gap-3">
    <div class="w-53">
      <ul class="mb-3">
        <li class="m1-">
          <RouterLink to="/accounts">Dashboard</RouterLink>
        </li>
        <li class="m1-">
          <RouterLink to="/accounts/profile">Profile</RouterLink>
        </li>
        <li class="m1-">
          <RouterLink to="/accounts/my-order">My Order</RouterLink>
        </li>
      </ul>
      <button class="px-3 py-1 bg-amber-700 text-white">Logout</button>
    </div>
    <div class="flex-1">
      <RouterView></RouterView>
    </div>
  </div>
</template>
