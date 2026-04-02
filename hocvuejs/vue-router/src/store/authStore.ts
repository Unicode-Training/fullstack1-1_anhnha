import { defineStore } from "pinia";
import { axiosInstance } from "../libs/axios";

export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      user: {},
      isAuthenticated: false,
      isLoading: true,
    };
  },
  actions: {
    async profile() {
      const accessToken = localStorage.getItem("accessToken");
      if (!accessToken) {
        this.isLoading = false;
        return;
      }
      try {
        const response = await axiosInstance.get(`/auth/profile`, {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        });
        const user = response.data;

        this.user = user;
        this.isAuthenticated = true;
      } catch {
        this.user = {};
        this.isAuthenticated = false;
      } finally {
        this.isLoading = false;
      }
    },
  },
});
