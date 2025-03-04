<template>
  <q-card>
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
      <q-btn type="submit" label="Cancel" color="negative" @click="$emit('closeDialog')" />
    </div>
  </q-card>
</template>
<script setup>
import { ref, computed } from "vue";
import { useAuthStore } from "src/stores/auth.store";
import { useUploadStore } from "src/stores/upload.store";

const emit = defineEmits(["closeDialog"]);
const authStore = useAuthStore();
const uploadStore = useUploadStore();
const user = computed(() => authStore.user);
const file = ref(null);

async function handleUpload() {
    await uploadStore.upload(file.value, user.value.id);
    emit("closeDialog");
}

</script>
