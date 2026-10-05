<template>
  <h1 class="text-3xl">Login</h1>

  <form @submit.prevent="handleSubmit">
    <div class="mb-3">
      <label for="" class="block font-medium">Email</label>
      <input
        type="email"
        class="px-3 py-1 border border-[#ddd] outline-0"
        placeholder="Email..."
        v-model="form.email"
      />
    </div>
    <div class="mb-3">
      <label for="" class="block font-medium">Password</label>
      <input
        type="password"
        class="px-3 py-1 border border-[#ddd] outline-0"
        placeholder="Password..."
        v-model="form.password"
      />
    </div>
    <button class="bg-green-900 px-3 py-1 outline-0 text-white">Login</button>
  </form>
</template>
<script lang="ts" setup>
import { saveToken } from "~~/utils/utils";

const config = useRuntimeConfig();
type LoginForm = {
  email: string;
  password: string;
};
const form = ref({} as LoginForm);
const handleSubmit = async () => {
  try {
    const token = await $fetch<{
      data: { accessToken: string; refreshToken: string };
    }>(`${config.public.laravelServer}/auth/login`, {
      method: "post",
      body: form.value,
    });
    await saveToken(token.data);
  } catch {
    console.log("failed");
  }
};
</script>
