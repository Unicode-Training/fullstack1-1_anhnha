import type { NavigationGuardNext, RouteLocationNormalized } from "vue-router";

const isAuth = true;
export const authMiddleware = (
  _to: RouteLocationNormalized,
  _from: RouteLocationNormalized,
  next: NavigationGuardNext,
) => {
  if (isAuth) {
    next(); //Cho tiếp tới url hiện tại
  } else {
    next({
      name: "home",
    });
  }
};
