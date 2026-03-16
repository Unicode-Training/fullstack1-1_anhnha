<template>
  <div
    class="max-w-[80%] mx-auto mt-5 border border-[#ddd] p-3 fixed top-0 left-0 right-0 bg-white z-9999"
  >
    <div class="flex justify-between border-b border-[#ddd]">
      <h2 class="text-2xl">{{ title }}</h2>
      <span class="text-2xl cursor-pointer" @click="handleClose">&times;</span>
    </div>
    <div class="mt-3">
      <slot></slot>
    </div>
  </div>
  <div class="bg-[#00000080] fixed inset-0 z-999" @click="handleClose"></div>
</template>
<script setup lang="ts">
defineProps(["title"]);
const emit = defineEmits(["close"]);
const handleClose = () => {
  emit("close");
};
document.addEventListener("keyup", (e) => {
  if (e.key === "Escape") {
    emit("close");
  }
});
</script>
