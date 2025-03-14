<template>
  <div>
    <q-card class="page-container">
      <div v-if="authStore.isLoading && uploadStore.isLoading">
        <q-circular-progress
          indeterminate
          rounded
          size="200px"
          color="secondary"
          class="q-ma-md fixed-center"
        />
      </div>
      <div v-else>
        <div class="image-container" v-for="upload in uploads" :key="upload.id">
          <FeedBox :upload="upload" />
        </div>
      </div>
    </q-card>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth.store";
import { useUploadStore } from "../stores/upload.store";
import FeedBox from "src/components/FeedBox.vue";

const authStore = useAuthStore();
const uploadStore = useUploadStore();
const uploads = computed(() => uploadStore.allUploads);

onMounted(async () => {
  await authStore.getUser();
  await uploadStore.getAllUploads();
});
</script>
