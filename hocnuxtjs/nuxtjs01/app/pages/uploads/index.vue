<template>
  <input type="file" @change="handleChange" />
  <img v-if="imagePreview" :src="imagePreview" width="300" />

  <div ref="divRef" class="h-300 border border-[#ddd]">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit
    accusamus exercitationem quis est laboriosam modi provident ipsum, aut
    dignissimos quas, quos ab perspiciatis quod aliquid atque porro quidem
    nobis!
  </div>
  <button @click="handleDownload">Download</button>
</template>
<script lang="ts" setup>
const imagePreview = ref("");
const divRef = ref();
const handleChange = (e: Event) => {
  const target = e.target as HTMLInputElement;
  const file = target.files?.[0];
  const url = URL.createObjectURL(file!);
  imagePreview.value = url;
};
watch(imagePreview, (value: string, oldValue: string) => {
  URL.revokeObjectURL(oldValue);
});
const handleDownload = () => {
  const content = divRef.value.innerText as any;
  const blob = new Blob([content], { type: "text/plain" });
  const url = URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = "abc.txt";
  a.click();
};
</script>
