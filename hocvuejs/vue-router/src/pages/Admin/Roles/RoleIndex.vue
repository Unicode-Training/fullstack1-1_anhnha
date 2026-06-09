<template>
  <h1 class="text-3xl mb-3">Roles</h1>
  <div
    class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default"
  >
    <table class="w-full text-sm text-left rtl:text-right text-body">
      <thead
        class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default"
      >
        <tr>
          <th scope="col" class="px-6 py-3 font-medium">Tên</th>
          <th scope="col" class="px-6 py-3 font-medium">Quyền</th>
          <th scope="col" class="px-6 py-3 font-medium">Người dùng</th>
          <th scope="col" class="px-6 py-3 font-medium">Sửa</th>
          <th scope="col" class="px-6 py-3 font-medium">Xóa</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="role in roles"
          class="bg-neutral-primary border-b border-default"
        >
          <td
            scope="row"
            class="px-6 py-4 font-medium text-heading whitespace-nowrap"
          >
            {{ role.name }}
          </td>
          <td class="px-6 py-4">
            {{
              role.permissions.length
                ? role.permissions.join(",")
                : "Không có quyền"
            }}
          </td>
          <td class="px-6 py-4">
            <RouterLink
              :to="{
                name: 'admin.roles.user',
                params: {
                  id: role.id,
                },
              }"
              >Gán</RouterLink
            >
          </td>
          <td class="px-6 py-4">
            <RouterLink
              :to="{
                name: 'admin.roles.update',
                params: {
                  id: role.id,
                },
              }"
              >Sửa</RouterLink
            >
          </td>
          <td class="px-6 py-4">
            <RouterLink to="">Xóa</RouterLink>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { axiosInstance } from "../../../libs/axios";
import type { Role } from "../../../types/role.type";
import { RouterLink } from "vue-router";

const roles = ref<Role[]>([]);

const getRoles = async () => {
  try {
    const response = await axiosInstance.get(`/admin/roles`);
    const { data } = response.data;
    roles.value = data;
  } catch {}
};
getRoles();
</script>
