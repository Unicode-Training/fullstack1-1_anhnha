<template>
  <h2>Header</h2>
  {{ animationName }}
</template>
<script setup lang="ts">
const props = defineProps(["animationName"]);
//animationName --> animation-name
//camelCase --> underscore
</script>
