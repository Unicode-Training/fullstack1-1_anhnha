<script setup lang="ts"></script>

<template>
  <main class="max-w-[80%] mx-auto flex">
    <div class="w-53">
      <h2 class="text-3xl font-medium">Admin</h2>
      <ul>
        <li><RouterLink to="/admin">Dashboard</RouterLink></li>
        <li><RouterLink to="/admin/users">Users</RouterLink></li>
      </ul>
    </div>
    <div class="flex-1">
      <RouterView></RouterView>
    </div>
  </main>
</template>
