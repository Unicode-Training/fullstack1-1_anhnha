<template>
  <div class="mb-3 border p-3">
    <h2>Name: {{ name }}</h2>
    <h2>Email: {{ email }}</h2>
    <div class="flex gap-3 mt-2">
      <button class="border px-3 py-1 cursor-pointer" @click="idEdit = id">
        Sửa
      </button>
      <button class="border px-3 py-1 cursor-pointer" @click="idDel = id">
        Xóa
      </button>
    </div>
  </div>
  <Modal title="Sửa thông tin" v-if="idEdit" @close="idEdit = 0">
    <EditUser
      :user="{
        id,
        name,
        email,
      }"
      @submit="handleSubmit"
    />
  </Modal>
  <Modal v-if="idDel" @close="idDel = 0" title="Bạn chắc chưa?">
    <DeleteUser @confirm="handleConfirm" />
  </Modal>
</template>
<script setup lang="ts">
import { ref } from "vue";
import EditUser from "./EditUser.vue";
import Modal from "./Modal.vue";
import DeleteUser from "./DeleteUser.vue";
defineProps(["name", "email", "id"]);
const emits = defineEmits(["submit", "delete"]);
const idEdit = ref(0);
const idDel = ref(0);
const handleSubmit = (data: { name: string; email: string }) => {
  emits("submit", data);
  idEdit.value = 0;
};
const handleConfirm = () => {
  emits("delete", idDel.value);
  idDel.value = 0;
};
</script>
