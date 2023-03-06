<template>
  <WeatherReport
    :show="showReport"
    :title="userInfo.name"
    subtitle="Weather Forecast"
    content="Here's a summary of the weather forecast showing some of the most important metrics"
    @close="showReport = false"
  />

  <div class="h-100hv grid sm:grid-cols-4 gap-3 p-2 sm:gap-6 sm:p-4">
    <WeatherInfoCard
      v-for="user in users"
      :key="user.id"
      :user="user"
      :channel="channelSubscription"
      @click="userStore.showUserReport(user)"
    />
  </div>
</template>

<script setup lang="ts">
import Pusher from "pusher-js";
import { storeToRefs } from "pinia";
import { useUserStore } from "@/stores/useUserStore";

import WeatherReport from "@/components/Weather/Modal/Report.vue";
import WeatherInfoCard from "@/components/Weather/InfoCard.vue";

const userStore = useUserStore();
const { users, showReport, userInfo } = storeToRefs(userStore);

userStore.loadUsers();

const pusher = new Pusher(import.meta.env.VITE_PUSHER_APP_KEY, {
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
});

const channelSubscription = pusher.subscribe("weather-channel");
</script>
