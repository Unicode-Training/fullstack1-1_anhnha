<template>
  <div class="flex">
    <div class="w-50">
      <ul>
        <li><RouterLink to="/accounts">Accounts</RouterLink></li>
        <li>
          <RouterLink to="/accounts/change-password"
            >Change Password</RouterLink
          >
        </li>
        <li>
          <RouterLink to="/accounts/order">Order</RouterLink>
        </li>
      </ul>
    </div>
    <div class="flex-1">
      <slot></slot>
    </div>
  </div>
</template>
