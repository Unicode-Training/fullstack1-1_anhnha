import axios from "axios";
import { useAuthStore } from "../store/authStore";
import { pinia } from "../main";
export const axiosInstance = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
});

//frontend -> 1 url backend chung

axiosInstance.interceptors.request.use(function (config) {
  const accessToken = localStorage.getItem("accessToken");
  if (accessToken) {
    config.headers.Authorization = `Bearer ${accessToken}`;
  }
  return config;
});

let refreshPromise: null | Promise<{
  accessToken: string;
  refreshToken: string;
}> = null;

axiosInstance.interceptors.response.use(
  (response) => {
    return response;
  },
  async (error) => {
    console.log({ error });
    if (error.status === 401 && error.config.url !== "/auth/refresh-token") {
      //Refresh
      if (!refreshPromise) {
        refreshPromise = requestRefreshToken();
      }
      const newToken = await refreshPromise;

      if (newToken) {
        refreshPromise = null;
        //lưu token vào localStorage
        localStorage.setItem("accessToken", newToken.accessToken);
        localStorage.setItem("refreshToken", newToken.refreshToken);
        //retry
        return axiosInstance(error.config); //tự động retry request đã bị failed
      }
      //Nếu refresh thất bại
      // - Xóa token khỏi localStorage
      // - Cập nhật lại state
      const authStore = useAuthStore(pinia);
      authStore.logout();
      // window.location.reload();
    }
    return Promise.reject(error);
  },
);

const requestRefreshToken = async () => {
  try {
    const refreshToken = localStorage.getItem("refreshToken");
    const response = await axiosInstance.post(`/auth/refresh-token`, {
      refreshToken,
    });
    return response.data.data;
  } catch {
    return false;
  }
};
