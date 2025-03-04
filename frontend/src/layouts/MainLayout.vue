<template>
  <q-layout>
    <q-dialog
      v-model="openUploadDialog"
      transition-show="slide-up"
      transition-hide="slide-down"
    >
      <CreateUpload @closeDialog="openUploadDialog = false" />
    </q-dialog>
    <q-page-container>
      <div class="main-layout-button-row">
        <q-btn
          type="submit"
          icon="mdi-plus"
          color="accent"
          class="q-ma-sm button"
          dense
          @click="openDialog"
        />
        <q-btn
          type="submit"
          :icon="router.currentRoute.value.name === 'dashboard' ? 'mdi-home' : 'mdi-view-dashboard'"
          color="secondary"
          class="q-ma-sm button"
          dense
          @click="router.currentRoute.value.name === 'dashboard' ? goHome() : goDashboard()"
        />

        <q-btn
          type="submit"
          icon="mdi-logout"
          color="negative"
          class="q-ma-sm button"
          dense
          @click="authStore.logout"
        />
      </div>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref, computed } from "vue";
import { useAuthStore } from "src/stores/auth.store";
import CreateUpload from "src/components/CreateUpload.vue";
import { useRouter } from "vue-router";

const router = useRouter();
const authStore = useAuthStore();
const openUploadDialog = ref(false);

defineOptions({
  name: "MainLayout",
});

function goHome() {
  router.push({ name: "home" });
}

function goDashboard() {
  router.push({ name: "dashboard" });
}

function openDialog() {
  openUploadDialog.value = true;
}
</script>
