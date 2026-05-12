import { authMiddleware } from "../middlewares/authMiddleware";
import { checkAdminMiddleware } from "../middlewares/checkAdminMiddleware";
import About from "../pages/About.vue";
import Dashboard from "../pages/Admin/Dashboard.vue";
import UserAdd from "../pages/Admin/Users/UserAdd.vue";
import UserIndex from "../pages/Admin/Users/UserIndex.vue";
import Login from "../pages/Auth/Login.vue";
import Contact from "../pages/Contact.vue";
import Home from "../pages/Home.vue";
import NotFound from "../pages/NotFound.vue";
import ProductAdd from "../pages/Products/ProductAdd.vue";
import ProductDetail from "../pages/Products/ProductDetail.vue";
import ProductIndex from "../pages/Products/ProductIndex.vue";
import ProductUpdate from "../pages/Products/ProductUpdate.vue";
import ThankYou from "../pages/ThankYou.vue";
import AccountIndex from "../pages/Accounts/Index.vue";
import AccountProfile from "../pages/Accounts/Profile.vue";
import AccountMyOrder from "../pages/Accounts/MyOrder.vue";

export const routes = [
  {
    component: () => import("../layouts/MainLayout.vue"),
    children: [
      { path: "/", component: Home, name: "home" },
      { path: "/gioi-thieu", component: About, name: "about" },
      { path: "/san-pham", component: ProductIndex, name: "products.index" },
      {
        path: "/san-pham/:productId",
        component: ProductDetail,
        name: "products.detail",
      },
      {
        path: "/san-pham/create",
        component: ProductAdd,
        name: "products.create",
        beforeEnter: authMiddleware,
      },
      {
        path: "/san-pham/edit/:productId",
        component: ProductUpdate,
        name: "products.update",
        beforeEnter: authMiddleware,
      },
      { path: "/contact", component: Contact, name: "contact" },
      { path: "/cam-on", component: ThankYou, name: "thankyou" },
      {
        path: "/accounts",
        component: () => import("../pages/Accounts/Layout.vue"),
        children: [
          {
            path: "",
            component: AccountIndex,
            name: "account.index",
          },
          {
            path: "profile",
            component: AccountProfile,
            name: "account.profile",
          },
          {
            path: "my-order",
            component: AccountMyOrder,
            name: "account.my-order",
          },
        ],
      },
      {
        path: "/auth/login",
        component: Login,
        name: "auth.login",
      },
    ],
  },

  {
    path: "/admin",
    component: () => import("../layouts/AdminLayout.vue"),
    beforeEnter: [authMiddleware, checkAdminMiddleware],
    children: [
      {
        path: "",
        component: Dashboard,
        name: "admin.dashboard",
      },
      {
        path: "users",

        children: [
          {
            path: "",
            component: UserIndex,
            name: "admin.users.index",
          },
          {
            path: "create",
            component: UserAdd,
            name: "admin.users.create",
          },
        ],
      },
    ],
  },

  { path: "/:pathMatch(.*)*", component: NotFound, name: "not-found" },
];
