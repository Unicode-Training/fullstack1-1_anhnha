import type { NavigationGuardNext, RouteLocationNormalized } from "vue-router";
import { useAuthStore } from "../store/authStore";

export const permissionMiddleware = (permissionName: string) => async (
    _to: RouteLocationNormalized,
    _from: RouteLocationNormalized,
    next: NavigationGuardNext,
) => {
    //Check auth
    const authStore = useAuthStore();
    if (authStore.user.role === 'ADMIN') {
        return next();
    }
    //   await authStore.profile();
    if (!authStore.user.permissions.includes(permissionName)) {
        next({ name: "admin.forbidden" });
    } else {
        next();
    }

};

//Closure