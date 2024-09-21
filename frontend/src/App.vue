<template>
  <router-view />
</template>

<script setup>
defineOptions({
  name: "App",
});

import { useRouter } from "vue-router";

// const router = useRouter();

// const isAuth = () => {
//   return localStorage.getItem("token") ? true : false;
// };

// if (!isAuth()) {
//   router.push("/auth/login");
// }
</script>
