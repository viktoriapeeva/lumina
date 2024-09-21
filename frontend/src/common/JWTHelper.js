import { api } from "../boot/axios";

export default class JwtService {
  static setHeaders() {
    api.defaults.headers.common[
      "Authorization"
    ] = `Bearer ${JwtService.getToken()}`;
  }

  static removeHeaders() {
    api.defaults.headers.common["Authorization"] = "";
  }

  static getToken() {
    return localStorage.getItem("access_token");
  }

  static saveToken(token) {
    localStorage.setItem("access_token", token);
    document.dispatchEvent(
      new CustomEvent("jwtTokenChanged", { detail: token })
    );
  }

  static destroyToken() {
    localStorage.removeItem("access_token");
  }
}
