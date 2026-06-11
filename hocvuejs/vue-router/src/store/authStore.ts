import { defineStore } from "pinia";
import { axiosInstance } from "../libs/axios";
import type { User } from "../types/auth.type";

export const useAuthStore = defineStore("auth", {
  state: () => {
    return {
      user: {} as User,
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
        this.user = {} as User;
        this.isAuthenticated = false;
      } finally {
        this.isLoading = false;
      }
    },
    can(name: string) {
      if (this.user.role === 'ADMIN') {
        return true;
      }
      const permissions = this.user.permissions;
      return permissions.includes(name);
    },
    async logout() {
      const accessToken = localStorage.getItem("accessToken");
      try {
        await axiosInstance.delete(`/auth/logout`, {
          headers: {
            Authorization: `Bearer ${accessToken}`,
          },
        });
      } finally {
        localStorage.removeItem("accessToken");
        localStorage.removeItem("refreshToken");
        this.isLoading = false;
        this.user = {} as User;
        this.isAuthenticated = false;
      }
    },
  },
});

//Logout --> Gọi api back-end --> Xóa localStorage --> Cập nhật lại store
