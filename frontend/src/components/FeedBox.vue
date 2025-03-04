<template>
  <q-card>
    <q-card-section>
      <q-item>
        <q-item-section avatar>
          <q-avatar>
            <img src="https://cdn.quasar.dev/img/boy-avatar.png" />
          </q-avatar>
        </q-item-section>

        <q-item-section>
          <q-item-label>{{ props.upload.name }}</q-item-label>
          <q-item-label caption> {{ user.name }} </q-item-label>
        </q-item-section>
      </q-item>
      <q-img
        :key="props.upload.name"
        :src="'http://localhost:8000/' + props.upload.path"
      ></q-img>
      <q-card-actions horizontal class="justify-around">
        <q-btn
          flat
          round
          color="accent"
          icon="mdi-thumb-up"
          @click="handleLike"
        />
        <q-btn
          flat
          round
          color="negative"
          :icon="isFavorite ? 'mdi-heart' : 'mdi-heart-outline'"
          @click="isFavorite ? handleUnfavorite() : handleFavorite()"
        />
        <q-btn flat round color="primary" icon="share" />
      </q-card-actions>
    </q-card-section>
  </q-card>
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
