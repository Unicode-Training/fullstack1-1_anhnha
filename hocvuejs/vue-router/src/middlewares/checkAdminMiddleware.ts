import type { NavigationGuardNext, RouteLocationNormalized } from "vue-router";
import { useAuthStore } from "../store/authStore";

export const checkAdminMiddleware = async (
  _to: RouteLocationNormalized,
  _from: RouteLocationNormalized,
  next: NavigationGuardNext,
) => {
  //Check auth
  const authStore = useAuthStore();
  const user = authStore.user;
  if (user.role === "CUSTOMER") {
    next({ name: "home" });
  } else {
    next();
  }
};
