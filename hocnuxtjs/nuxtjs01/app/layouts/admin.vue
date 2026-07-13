<template>
  <div class="flex">
    <div class="w-70">
      <ul>
        <li><RouterLink to="/admin">Dashboard</RouterLink></li>
        <li><RouterLink to="/users">Users</RouterLink></li>
      </ul>
    </div>
    <div class="flex-1">
      <slot></slot>
    </div>
  </div>
</template>
