<template>
  <NuxtLayout :name="dynamicLayout">
    <NuxtPage />
  </NuxtLayout>
</template>
<script setup>
const dynamicLayout = ref("account");
const route = useRoute();
watch(
  () => route.path,
  (value) => {
    if (value.startsWith("/accounts/order")) {
      dynamicLayout.value = "order";
    }
  },
  {
    immediate: true,
  },
);
</script>
