import { createApp } from "vue";
import { createWebHistory, createRouter } from "vue-router";
import "./style.css";
import App from "./App.vue";
import { createPinia } from "pinia";
export const pinia = createPinia();
import { routes } from "./routes/index";
import Vue3Toastify, { type ToastContainerOptions } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';


export const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App).use(Vue3Toastify,
  {
    autoClose: 3000,
    // ...
  } as ToastContainerOptions,).use(pinia).use(router).mount("#app");
