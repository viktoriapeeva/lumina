<template>
  <div>
    <q-img
      :key="props.upload.name"
      :src="'http://localhost:8000/' + props.upload.path"
    >
    </q-img>
    <!-- add buttons  -->
    <q-btn flat round color="accent" icon="mdi-thumb-up" @click="handleLike" />
  </div>
</template>
<script setup>
const props = defineProps({
  upload: {
    type: Object,
  },
});

async function handleLike() {
  console.log("Like button clicked");
}
</script>
