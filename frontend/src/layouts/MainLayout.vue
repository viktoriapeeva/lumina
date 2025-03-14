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
          :icon="
            router.currentRoute.value.name === 'dashboard'
              ? 'mdi-home'
              : 'mdi-view-dashboard'
          "
          color="secondary"
          class="q-ma-sm button"
          dense
          @click="
            router.currentRoute.value.name === 'dashboard'
              ? goHome()
              : goDashboard()
          "
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
      <q-drawer v-model="drawer" show-if-above :width="200" :breakpoint="400">
        <q-img
          class="absolute-top"
          src="src/assets/images/lumina.png"
          style="height: 100px; padding-top: 200px"
        >
        </q-img>
        <q-scroll-area style="height: calc(100% - 150px); margin-top: 150px">
          <q-list padding>
            <q-item
              clickable
              v-ripple
              @click="goHome"
              :active="router.currentRoute.value.name === 'home'"
            >
              <q-item-section avatar>
                <q-icon name="home" />
              </q-item-section>

              <q-item-section> Home </q-item-section>
            </q-item>

            <q-item
              clickable
              v-ripple
              @click="goDiscover"
              :active="router.currentRoute.value.name === 'dashboard'"
            >
              <q-item-section avatar>
                <q-icon name="search" />
              </q-item-section>

              <q-item-section> Discover </q-item-section>
            </q-item>

            <q-item
              clickable
              v-ripple
              @click="goDashboard"
              :active="router.currentRoute.value.name === 'dashboard'"
            >
              <q-item-section avatar>
                <q-icon name="mdi-view-dashboard" />
              </q-item-section>

              <q-item-section> My Dashboard </q-item-section>
            </q-item>

            <q-item clickable v-ripple @click="authStore.logout">
              <q-item-section avatar>
                <q-icon name="mdi-logout" />
              </q-item-section>

              <q-item-section> Log Out </q-item-section>
            </q-item>
          </q-list>
        </q-scroll-area>
      </q-drawer>
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
const drawer = ref(false);

defineOptions({
  name: "MainLayout",
});

function goHome() {
  router.push({ name: "home" });
}

function goDashboard() {
  router.push({ name: "dashboard" });
}

function goDiscover() {
  router.push({ name: "dashboard" });
}

function openDialog() {
  openUploadDialog.value = true;
}
</script>
