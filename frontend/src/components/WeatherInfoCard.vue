<template>
  <div
    class="bg-indigo-100/75 rounded-lg border border-violet-200 shadow-lg px-2 py-1 hover:cursor-pointer hover:shadow-2xl sm:px-4"
  >
    <div class="flex justify-between items-center my-2">
      <div>
        <h3 class="font-semibold text-base sm:text-lg">{{ user.name }}</h3>
        <span class="text-gray-500 text-xs">
          Pressure:
          <span class="text-gray-600 font-semibold">
            {{ user.weather.pressure }}
          </span>
          hPa
        </span>
      </div>
      <div class="flex items-center justify-between w-5/12 sm:w-2/5">
        <img
          class="w-12 h-12 bg-violet-300/75 rounded-full"
          :src="userStore.weatherIconUrl(user.weather.weather_icon)"
          alt="weather icon"
        />
        <div>
          <p class="font-bold mr-2 text-violet-600/75 text-lg sm:text-2xl">
            {{ user.weather.temperature }}°F
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useUserStore } from "@/stores/useUserStore";
import type { User } from "@/stores/useUserStore";

interface Props {
  user: User;
  channel: Object;
}

const props = defineProps<Props>();

const userStore = useUserStore();
const eventName = `weather.updated.${props.user.id}`;

props.channel.bind(eventName, function (user: User) {
  userStore.$patch((state) => (state.users[props.user.id] = user));
});
</script>
