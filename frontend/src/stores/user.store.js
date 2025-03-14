import { defineStore } from "pinia";
import { api } from "../boot/axios";

export const useUserStore = defineStore("user", {
  state() {
    return {
      isLoading: true,
      user: null,
      uploads: [],
    };
  },
  actions: {
    async getUser($id) {
      try {
        this.isLoading = true;
        const { data } = await api.get("api/users/" + $id);
        this.user = data.data;
        console.log(data.data);
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },

    async updateUser($id, $data) {
      try {
        this.isLoading = true;
        const { data } = await api.put("api/users/" + $id, $data);
        this.user = data.data;
        console.log(data);
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },

    // async getUploads() {
    //   try {
    //     this.isLoading = true;
    //     const { data } = await api.get("api/uploads/");
    //     this.uploads = data.data;
    //     console.log(data);
    //   } catch (error) {
    //     console.error(error);
    //   } finally {
    //     this.isLoading = false;
    //   }
    // },
  },
});
