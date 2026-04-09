<template>
  <h1 class="text-3xl">Login</h1>
  <form @submit.prevent="handleSubmit">
    <div class="mb-3">
      <label for="" class="block font-medium">Email</label>
      <input
        type="email"
        class="px-3 py-1 outline-0 border border-[#ddd]"
        placeholder="Email..."
        v-model="form.email"
      />
    </div>
    <div class="mb-3">
      <label for="" class="block font-medium">Password</label>
      <input
        type="password"
        class="px-3 py-1 outline-0 border border-[#ddd]"
        placeholder="Password..."
        v-model="form.password"
      />
    </div>
    <button class="px-3 py-1 outline-0 bg-green-900 text-white">Login</button>
  </form>
</template>
<script setup lang="ts">
type LoginForm = {
  email: string;
  password: string;
};
import { ref } from "vue";
import { axiosInstance } from "../../libs/axios";
import { useAuthStore } from "../../store/authStore";
import { useRouter } from "vue-router";

const form = ref({} as LoginForm);

const authStore = useAuthStore();

const router = useRouter();

const handleSubmit = async () => {
  try {
    const response = await axiosInstance.post("/auth/login", form.value);
    const { data: token } = response.data;
    localStorage.setItem("accessToken", token.accessToken);
    localStorage.setItem("refreshToken", token.refreshToken);
    authStore.profile();
    router.push({
      name: "home",
    });
  } catch {
    console.log("Login thất bại");
  }
};
</script>
