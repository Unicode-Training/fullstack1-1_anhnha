import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";
import "./style.css";
import App from "./App.vue";
import { createPinia } from "pinia";
export const pinia = createPinia();
import { routes } from "./routes/index";

export const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(pinia).use(router).mount("#app");
