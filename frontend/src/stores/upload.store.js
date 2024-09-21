import { defineStore } from "pinia";
import { api } from "../boot/axios";

export const useUploadStore = defineStore("upload", {
  state() {
    return {
      isLoading: true,
      uploads: [],
    };
  },
  actions: {
    async getUploads() {
      try {
        this.isLoading = true;
        const { data } = await api.get("api/uploads/");
        this.uploads = data.data;
        console.log(data);
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },
  },
});
