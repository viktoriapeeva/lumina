import { api } from "../boot/axios";
import JwtService from "../common/JWTHelper";

class AuthService {
  async login(formData) {
    try {
      // JwtService.removeHeaders();

      const { data } = await api.post("/api/auth/login", formData);
      JwtService.saveToken(data.access_token);
      return data;
    } catch (error) {
      JwtService.destroyToken();
      return Promise.reject(error);
    }
  }

  async fetchUser() {
    try {
      JwtService.setHeaders();
      const { data } = await api.get("/api/user");
      return data.user;
    } catch (error) {
      JwtService.destroyToken();
      // JwtService.removeHeaders();
      return Promise.reject(error);
    }
  }

  async logout() {
    JwtService.destroyToken();

    window.location.href = "/auth/login";
  }
}

export default new AuthService();
