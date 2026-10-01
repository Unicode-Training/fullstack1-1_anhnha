<template>
  <slot></slot>
  <ProductUpdateModal
    v-if="id"
    :open="modalStatus"
    @close="modalStatus = false"
    :id="id"
  />
</template>
<script lang="ts" setup>
import { provide } from "vue";
import ProductUpdateModal from "../modals/ProductUpdateModal.vue";

const modalStatus = ref<boolean>(false);

const id = ref<number>(0);

provide("modalStatus", modalStatus);
provide("idUpdate", id);
</script>
