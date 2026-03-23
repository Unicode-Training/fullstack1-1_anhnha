<template>
  <header class="flex max-w-[80%] mx-auto py-3 items-center">
    <div>
      <h2 class="text-3xl font-bold">Unicode</h2>
    </div>
    <ul class="flex gap-3 ml-auto">
      <li>
        <RouterLink
          :to="{
            name: 'home',
          }"
          >Home</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'about',
          }"
          >About</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'products.index',
          }"
          >Products</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'contact',
          }"
          >Contact</RouterLink
        >
      </li>
      <li>
        <RouterLink
          :to="{
            name: 'admin.dashboard',
          }"
          >Admin</RouterLink
        >
      </li>
    </ul>
  </header>
</template>
