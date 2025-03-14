<template>
  <q-page class="flex flex-center">
    <img alt="Lumina logo" src="~assets/images/lumina-logo.png" />
    <div>
      <q-btn
        label="Login"
        color="primary"
        @click="() => $router.push('/login')"
      />
      <q-btn
        label="Register"
        color="primary"
        @click="() => $router.push('/register')"
      />
    </div>
  </q-page>
</template>

<script setup>
import { onMounted } from "vue";

onMounted(() => {
  console.log("IndexPage mounted");
});
</script>
