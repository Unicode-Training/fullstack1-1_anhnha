<template>
  <h1 class="text-3xl">Role Update</h1>
  <form @submit.prevent="handleUpdate">
    <div class="mb-3">
      <label for="" class="block mb-1">Name</label>
      <input
        type="text"
        class="px-3 py-1 border border-[#ddd] outline-0 w-full"
        placeholder="Name..."
        v-model="name"
      />
    </div>

    <div
      class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default"
    >
      <table class="w-full text-sm text-left rtl:text-right text-body">
        <thead
          class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default"
        >
          <tr>
            <th scope="col" class="px-6 py-3 font-medium w-1/5">Module</th>
            <th scope="col" class="px-6 py-3 font-medium">Quyền</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="module in MODULES"
            class="bg-neutral-primary border-b border-default"
          >
            <th
              scope="row"
              class="px-6 py-4 font-medium text-heading whitespace-nowrap"
            >
              {{ module.title }}
            </th>
            <td class="px-6 py-4">
              <div class="flex flex-wrap">
                <label class="block w-1/5" v-for="action in module.actions">
                  <input
                    type="checkbox"
                    v-model="permissions"
                    :value="module.name + '.' + action"
                  />
                  {{ action.charAt(0).toUpperCase() + action.slice(1) }}
                </label>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <button class="bg-green-600 text-white px-3 py-2 mt-3">Update</button>
  </form>
</template>
<script setup lang="ts">
import { ref } from "vue";
import { axiosInstance } from "../../../libs/axios";
import { useRoute, useRouter } from "vue-router";

const MODULES = [
  {
    name: "products",
    title: "Sản phẩm",
    actions: ["list", "create", "update", "delete"],
  },
  {
    name: "users",
    title: "Người dùng",
    actions: ["list", "create", "update", "delete"],
  },
  {
    name: "orders",
    title: "Đơn hàng",
    actions: ["list", "create", "update", "delete"],
  },
];
const route = useRoute();
const id = route.params.id;
const name = ref("");
const permissions = ref([]);
const handleUpdate = async () => {
  const response = await axiosInstance.put(`/admin/roles/${id}`, {
    name: name.value,
    permissions: permissions.value,
  });
  console.log(response);
};

const getRole = async (id: number) => {
  const response = await axiosInstance.get(`/admin/roles/${id}`);
  const { data } = response.data;
  name.value = data.name;
  permissions.value = data.permissions;
};

getRole(id as unknown as number);
</script>
