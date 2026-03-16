<template>
  <form @submit.prevent="handleSave">
    <div class="mb-3">
      <label class="mb-1 font-medium">Name</label>
      <input
        type="text"
        placeholder="Name..."
        class="w-full py-1 px-2 border border-[#ddd] outline-0"
        v-model="name"
      />
      <span v-if="errors.name" class="text-red-600">{{ errors.name }}</span>
    </div>
    <div class="mb-3">
      <label class="mb-1 font-medium">Email</label>
      <input
        type="email"
        placeholder="Email..."
        class="w-full py-1 px-2 border border-[#ddd] outline-0"
        v-model="email"
      />
      <span v-if="errors.email" class="text-red-600">{{ errors.email }}</span>
    </div>
    <button class="px-3 py-1 bg-green-700 text-white">Save</button>
  </form>
</template>
<script lang="ts" setup>
import { ref } from "vue";

type ErrorType = {
  name: string;
  email: string;
};
const { user } = defineProps(["user"]);

const emit = defineEmits(["submit"]);
const name = ref("");
const email = ref("");
const errors = ref<ErrorType>({} as ErrorType);
name.value = user.name;
email.value = user.email;

const handleSave = () => {
  errors.value = {} as ErrorType;
  if (!name.value) {
    errors.value.name = "Tên bắt buộc phải nhập";
  }
  if (!email.value) {
    errors.value.email = "Email bắt buộc phải nhập";
  }

  if (!Object.keys(errors.value).length) {
    emit("submit", {
      id: user.id,
      name: name.value,
      email: email.value,
    });
  }
};
</script>
