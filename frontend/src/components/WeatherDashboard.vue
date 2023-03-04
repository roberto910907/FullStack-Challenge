<template>
  <div class="h-100hv grid grid-cols-4 gap-4 p-4">
    <div
      class="bg-gray-600 w-full rounded border-zinc-700 text-white"
      v-for="user in users"
      :key="user.id"
    >
      <p class="p-5">{{ user.id }} {{ user.email }}</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from "pinia";
import { useUserStore } from "@/stores/useUserStore";

const userStore = useUserStore();
const { users } = storeToRefs(userStore);

userStore.loadUsers();
</script>
