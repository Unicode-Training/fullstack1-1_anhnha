// https://nuxt.com/docs/api/configuration/nuxt-config
import tailwindcss from "@tailwindcss/vite";
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',
  devtools: { enabled: true },
  vite: {
    plugins: [
      tailwindcss(),
    ],
  },
  css: ['./index.css'],
  runtimeConfig: {
    public: {
      apiServer: process.env.NUXT_PUBLIC_API_SERVER,
    },
    geminiKey: process.env.GEMINI_KEY
  }
})
