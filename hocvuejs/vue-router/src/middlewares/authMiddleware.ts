import type { NavigationGuardNext, RouteLocationNormalized } from "vue-router";
import { useAuthStore } from "../store/authStore";

export const authMiddleware = async (
  _to: RouteLocationNormalized,
  _from: RouteLocationNormalized,
  next: NavigationGuardNext,
) => {
  //Check auth
  const authStore = useAuthStore();
  await authStore.profile();
  if (!authStore.isLoading) {
    if (authStore.isAuthenticated) {
      next();
    } else {
      next({ name: "auth.login" });
    }
  }
};
