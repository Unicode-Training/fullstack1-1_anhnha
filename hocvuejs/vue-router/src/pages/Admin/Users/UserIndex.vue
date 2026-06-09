<template>
  <h1 class="text-3xl">User Index</h1>
  <RouterLink
    :to="{ name: 'admin.users.create' }"
    class="px-3 py-1 bg-green-600"
    >Add User</RouterLink
  >
</template>
