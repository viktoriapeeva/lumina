import { defineStore } from "pinia";
import { api } from "../boot/axios";

export const useUploadStore = defineStore("upload", {
  state() {
    return {
      isLoading: true,
      uploads: [],
      allUploads: [],
      favoriteUploads: [],
    };
  },
  actions: {
    async getUploads() {
      try {
        this.isLoading = true;
        const { data } = await api.get("api/uploads/");
        this.uploads = data.data;
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },
    async getAllUploads() {
      try {
        this.isLoading = true;
        const { data } = await api.get("api/uploads/discover");
        this.allUploads = data.data;
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },
    async upload(file, user_id) {
      try {
        const formData = new FormData();
        formData.append("image", file);
        formData.append("name", file.name);
        formData.append("size", file.size);
        formData.append("type", file.type);
        formData.append("user_id", user_id);
        const { data } = await api.post("api/uploads/", formData);
        this.getUploads();
      } catch (error) {
        console.error(error);
      }
    },
    async likeUpload(upload_id) {
      try {
        await api.put(`api/uploads/${upload_id}/like`);
        this.getUploads();
      } catch (error) {
        console.error(error);
      }
    },
    async dislikeUpload(upload_id) {
      try {
        await api.put(`api/uploads/${upload_id}/dislike`);
        this.getUploads();
      } catch (error) {
        console.error(error);
      }
    },
    async favoriteUpload(upload_id) {
      try {
        await api.put(`api/uploads/${upload_id}/favourite`);
        this.getAllFavourites();
      } catch (error) {
        console.error(error);
      }
    },
    async unfavoriteUpload(upload_id) {
      try {
        await api.delete(`api/uploads/${upload_id}/unfavourite`);
        this.getAllFavourites();
      } catch (error) {
        console.error(error);
      }
    },
    async getAllFavourites() {
      try {
        this.isLoading = true;
        const { data } = await api.get("api/uploads/favourites");
        this.favoriteUploads = data.data;
      } catch (error) {
        console.error(error);
      } finally {
        this.isLoading = false;
      }
    },
  },
});
