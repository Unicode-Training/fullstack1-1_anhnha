<template>
  <h1 class="text-3xl">Account: {{ user!.name }}</h1>
  <button class="bg-green-600 px-3 py-1 text-white" @click="handleClick">
    Click me
  </button>
</template>
<script lang="ts" setup>
const { data: user, refresh } = await useApi<{ name: string }>(
  "/auth/profile2",
);
console.log(user);
const handleClick = async () => {
  await refresh();
};
</script>
