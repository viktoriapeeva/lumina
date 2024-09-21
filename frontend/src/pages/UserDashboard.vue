<template>
  <div>
    <q-card>
      <div v-if="authStore.isLoading">
        <q-skeleton />
        <q-skeleton />
        <q-skeleton />
      </div>
      <div v-else>
        <q-card-section>
          <div class="text-h6">
            <q-avatar
              :src="user.avatar"
              text-color="white"
              class="q-ma-md"
              color="secondary"
            >
              <template v-slot:default>
                <q-icon name="person" />
              </template>
            </q-avatar>
            {{ user.name }}
          </div>
        </q-card-section>
      </div>
    </q-card>

    <!-- Uploads section -->

    <q-card>
      <q-card-section>
        <div class="text-h6">Uploads</div>
      </q-card-section>
      <!-- button add new upload -->
      <q-card-section>
        <q-btn type="submit" label="Add new upload" color="accent" />
      </q-card-section>

      <q-card-section>
        <q-list>
          <q-item v-for="upload in userStore.user.uploads" :key="upload.id">
            <q-item-section>
              <q-item-label>
                <q-item-label-header>
                  {{ upload.title }}
                </q-item-label-header>
                <q-item-label-detail>
                  {{ upload.description }}
                </q-item-label-detail>
              </q-item-label>
            </q-item-section>
          </q-item>
        </q-list>
      </q-card-section>
    </q-card>
  </div>
  <!-- log out button -->
  <!-- <q-btn
    type="submit"
    label="Log out"
    color="primary"
    class="full-width"
    @click="authStore.logout"
  /> -->
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth.store";

const authStore = useAuthStore();

const user = computed(() => authStore.user);

onMounted(async () => {
  await authStore.getUser();
});
</script>
