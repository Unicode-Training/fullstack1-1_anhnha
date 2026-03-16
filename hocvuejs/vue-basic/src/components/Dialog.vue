<template>
  <div class="border border-red-600 p-5">
    <h2>Dialog</h2>
    <button @click="$emit('bam')">Click me</button>
  </div>
</template>
<script setup lang="ts">
// const emit = defineEmits(["bam"]);
// const handeClick = () => {
//   emit("bam");
// };
</script>
