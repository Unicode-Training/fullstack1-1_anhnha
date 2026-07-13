<template>
  <div class="flex">
    <div class="w-50">
      <ul>
        <li><RouterLink to="/accounts/order">Order List</RouterLink></li>
        <li>
          <RouterLink to="/accounts/order/cancel">Order Cancel</RouterLink>
        </li>
      </ul>
    </div>
    <div class="flex-1">
      <slot></slot>
    </div>
  </div>
</template>
