<template>
  <p>Nếu bấm đồng ý bạn sẽ không phục lại được</p>
  <button
    @click="$emit('confirm')"
    class="px-3 py-1 bg-red-600 text-white mt-2 cursor-pointer"
  >
    Đồng ý
  </button>
</template>
