<template>
  <h1>Contact</h1>
  <form @submit.prevent="handleSubmit">
    <button>Gửi liên hệ</button>
  </form>
</template>
<script setup lang="ts">
import { useRouter } from "vue-router";

const router = useRouter();
const handleSubmit = () => {
  //Call api --> Gửi liên hệ cho back-end
  //Back-end xác nhận thành công
  //Front-end chuyển hướng
  router.push({
    name: "thankyou",
  });
};
</script>
