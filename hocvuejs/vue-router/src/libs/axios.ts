import axios from "axios";
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
