<template>
  <q-img
    :key="props.upload.name"
    :src="'http://localhost:8000/' + props.upload.path"
  ></q-img>
</template>
<script setup>
import { computed, onMounted } from "vue";
import { useAuthStore } from "../stores/auth.store";
import { useUploadStore } from "../stores/upload.store";

const authStore = useAuthStore();
const uploadStore = useUploadStore();
const user = computed(() => authStore.user);
const favorites = computed(() => uploadStore.favoriteUploads);
const props = defineProps({
  upload: {
    type: Object,
  },
});

const isFavorite = computed(() => {
  return favorites.value.some(
    (favorite) => favorite.upload_id === props.upload.id
  );
});

async function toggleIcon(upload) {}

async function handleLike() {
  await uploadStore.likeUpload(props.upload.id);
}

async function handleFavorite() {
  await uploadStore.favoriteUpload(props.upload.id);
}

async function handleUnfavorite() {
  const favorite = favorites.value.find(
    (favorite) =>
      favorite.upload_id === props.upload.id &&
      favorite.user_id === user.value.id
  );
  await uploadStore.unfavoriteUpload(favorite.id);
}

async function handleShare() {
  console.log("share");
}
</script>
