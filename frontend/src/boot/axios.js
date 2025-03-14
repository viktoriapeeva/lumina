import { boot } from "quasar/wrappers";
import axios from "axios";
import JwtService from "../common/JWTHelper";

const api = axios.create({ baseURL: "http://localhost:8000" });

// api.interceptors.request.use((config) => {
//   //  set header
//   JwtService.setHeaders();

//   return config;
// });

export default boot(({ app }) => {
  app.config.globalProperties.$axios = axios;

  app.config.globalProperties.$api = api;
});

export { axios, api };
