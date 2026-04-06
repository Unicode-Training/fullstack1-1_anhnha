import { authMiddleware } from "../middlewares/authMiddleware";
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

export const routes = [
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
    path: "/admin",
    beforeEnter: authMiddleware,
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
  {
    path: "/auth/login",
    component: Login,
    name: "auth.login",
  },
  { path: "/:pathMatch(.*)*", component: NotFound, name: "not-found" },
];
