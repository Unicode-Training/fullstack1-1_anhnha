<template>
  <h1 class="mb-3 text-3xl">Demo Scroll</h1>
  <div class="h-250">
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae magnam
      fugit velit non error, molestias hic deserunt labore a exercitationem
      facilis ut, laborum iure dolorum veniam doloremque quis dicta odit!
    </p>
  </div>
  <button v-if="value >= 100" class="right-5 bottom-5 fixed">Top</button>
</template>
<script lang="ts" setup>
const value = useScroll();
</script>
