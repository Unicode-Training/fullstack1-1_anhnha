<template>
  <h1>Content: {{ message }}</h1>
</template>
<script lang="ts" setup>
import { inject, type Ref } from "vue";

const message = inject<Ref<string>>("message");
</script>
