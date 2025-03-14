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
        <q-card-section>
          <div class="user-details">
            <div class="q-ma-md user-details-container">
              <q-avatar
                :src="user.avatar"
                text-color="white"
                class="q-ma-md"
                color="secondary"
                size="200px"
              >
                <template v-slot:default>
                  <q-icon name="person" />
                </template>
              </q-avatar>
              <div>
                <h5>
                  {{ user.name }}
                </h5>
                <q-icon name="email" />
                <span>{{ user.email }}</span>
              </div>
            </div>
            <div class="q-pa-md">
              <q-file
                v-model="file"
                label="Pick one file"
                filled
                style="max-width: 300px"
              />
              <q-btn
                type="submit"
                label="Upload"
                color="accent"
                class="q-ma-md"
                @click="handleUpload"
              />
            </div>
          </div>

          <!-- <q-btn
              type="submit"
              label="Log out"
              color="negative"
              class="q-ma-md"
              @click="authStore.logout"
            />
            <q-btn type="submit" label="Add new upload" color="accent" /> -->
        </q-card-section>

        <q-tabs v-model="tab" narrow-indicator dense align="justify">
          <q-tab
            class="text-purple"
            name="gallery"
            icon="collections"
            label="Gallery"
          />
          <q-tab
            class="text-red"
            name="favourites"
            icon="favorite"
            label="Favourites"
          />
          <q-tab
            class="text-teal"
            name="discovery"
            icon="public"
            label="Discovery"
          />
        </q-tabs>

        <q-tab-panels v-model="tab" animated>
          <q-tab-panel name="gallery">
            <div class="text-h6">Gallery</div>
            <div
              v-for="upload in uploads"
              :key="upload.id"
              class="image-container"
            >
              <q-img
                :key="upload"
                :src="'http://localhost:8000/' + upload.path"
              ></q-img>
            </div>
          </q-tab-panel>

          <q-tab-panel name="favourites">
            <div class="text-h6">Favourites</div>
            <div
              v-for="upload in favourites"
              :key="upload.upload.id"
              class="image-container"
            >
              <!-- <q-img
                :key="upload"
                :src="'http://localhost:8000/' + upload.upload.path"
              ></q-img> -->
              <FeedBox :upload="upload.upload" />
            </div>
          </q-tab-panel>

          <q-tab-panel name="discovery">
            <div class="text-h6">Discovery</div>
            <div
              v-for="upload in allUploads"
              :key="upload.id"
              class="image-container"
            >
              <FeedBox :upload="upload" />
            </div>
          </q-tab-panel>
        </q-tab-panels>
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
const tab = ref("gallery");
const file = ref(null);

const user = computed(() => authStore.user);
const uploads = computed(() => uploadStore.uploads);
const favourites = computed(() => uploadStore.favoriteUploads);
const allUploads = computed(() => uploadStore.allUploads);

onMounted(async () => {
  await authStore.getUser();
  await uploadStore.getUploads();
  await uploadStore.getAllFavourites();
  await uploadStore.getAllUploads();
});

async function handleUpload() {
  await uploadStore.upload(file.value, user.value.id);
}
</script>
