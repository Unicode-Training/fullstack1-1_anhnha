<template>
  <h1>Title: {{ message }}</h1>
  <button @click="handleClick!">Click me</button>
</template>
<script lang="ts" setup>
import { inject, type Ref } from "vue";
const message = inject<Ref<string>>("message");
const handleClick = () => {
  if (!message) {
    return;
  }
  message.value = "Xin chào";
};
</script>
