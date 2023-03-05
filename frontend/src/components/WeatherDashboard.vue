<template>
  <div class="h-100hv grid grid-cols-4 gap-4 p-4">
    <div
      v-for="user in users"
      :key="user.id"
      class="bg-indigo-100/75 rounded-lg border border-violet-200 shadow-lg px-4 py-1"
    >
      <div class="flex justify-between items-center my-2">
        <div>
          <h3 class="font-semibold text-lg">{{ user.name }}</h3>
          <span class="text-gray-500 text-xs">
            Pressure:
            <span class="text-gray-600 font-semibold">
              {{ user.weather.pressure }}
            </span>
            hPa
          </span>
        </div>
        <div class="flex items-center justify-between w-2/5">
          <img
            class="w-12 h-12 bg-violet-300/75 rounded-full"
            :src="userStore.weatherIconUrl(user.weather.weather_icon)"
            alt="weather icon"
          />
          <div>
            <p class="font-bold mr-2 text-violet-600/75 text-2xl">
              {{ user.weather.temperature }}°F
            </p>
          </div>
        </div>
      </div>
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
