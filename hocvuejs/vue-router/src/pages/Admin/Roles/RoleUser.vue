<template>
  <h1 class="text-3xl">Role User</h1>
  <form @submit.prevent="handleSave">
    <label class="block py-3" v-for="user in userList">
      <input
        type="checkbox"
        :value="user.id"
        :checked="roleUsers.includes(user.id)"
        v-model="userId"
      />
      {{ user.name }} -
      {{ user.email }}
    </label>

    <button class="bg-green-600 text-white px-3 py-2 mt-3">Update</button>
  </form>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { axiosInstance } from "../../../libs/axios";
import type { User } from "../../../types/auth.type";
import { toast } from "vue3-toastify";

import { useRoute } from "vue-router";
const userList = ref<User[]>([]);
const roleUsers = ref<number[]>([]);
const userId = ref<number[]>([]);
const route = useRoute();
const getUsers = async () => {
  const response = await axiosInstance.get("/admin/users");
  const { data } = response.data;
  userList.value = data;
};
const getUsersByRole = async () => {
  const response = await axiosInstance.get(
    `/admin/roles/${route.params.id}/users`,
  );
  const { data } = response;
  const userIds = data.map((item: { id: number }) => {
    return item.id;
  });
  roleUsers.value = userIds;
  userId.value = userIds;
};
const handleSave = async () => {
  await axiosInstance.put(
    `/admin/roles/${route.params.id}/users`,
    userId.value,
  );
  toast("Update success");
};
getUsers();
getUsersByRole();
</script>
