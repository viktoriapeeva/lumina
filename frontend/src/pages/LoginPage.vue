<template>
  <q-page class="flex flex-center background-box">
    <q-card square class="auth-box">
      <!-- logo title header-->
      <q-card-section>
        <div class="text-h4">Lumina</div>
      </q-card-section>

      <q-card-section>
        <div class="text-h6 auth-title">Login</div>
      </q-card-section>

      <q-form @submit="handleLogin">
        <q-card-section>
          <q-input v-model="email" label="Email" type="email" outlined />
        </q-card-section>

        <q-card-section>
          <q-input
            v-model="password"
            label="Password"
            type="password"
            outlined
            autocomplete="off"
          />
        </q-card-section>

        <q-card-section>
          <div class="text-caption">
            Don't have an account?
            <router-link to="/register">Register</router-link>
          </div>
          <q-btn
            type="submit"
            label="Login"
            color="accent"
            rounded
            class="auth-button"
          />
        </q-card-section>
      </q-form>
    </q-card>
  </q-page>
</template>

<script setup>
import { ref } from "vue";
import { useQuasar } from "quasar";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth.store";

const email = ref("");
const password = ref("");

const $q = useQuasar();
const authStore = useAuthStore();
const router = useRouter();
async function handleLogin() {
  const formData = {
    email: email.value,
    password: password.value,
  };
  try {
    await authStore.login(formData);
    router.push("/");
  } catch (error) {
    $q.notify({
      type: "negative",
      message: error.message,
    });
  }
}
</script>
