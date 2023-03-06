<template>
  <div class="relative z-10" v-if="show">
    <div
      class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    ></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
      <div
        class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
      >
        <div
          class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md sm:p-6"
        >
          <div class="absolute top-0 right-0 hidden pt-4 pr-4 sm:block">
            <button
              type="button"
              class="rounded-full p-1 bg-gray-200/75 text-gray-400 hover:bg-gray-300 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
              @click="$emit('close')"
            >
              <svg
                class="h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                aria-hidden="true"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>
          <div>
            <div class="mx-auto flex items-center justify-center">
              <img
                class="w-20 h-20 bg-violet-300/75 rounded-full"
                :src="userStore.weatherIconUrl(userInfo.weather.weather_icon)"
                alt="weather icon"
              />
            </div>
            <div class="mt-3 text-center sm:mt-5">
              <h3
                class="text-lg font-semibold leading-6 text-gray-900"
                id="modal-title"
              >
                {{ title }}
              </h3>
              <h3
                class="text-base font-semibold leading-6 text-violet-900"
                id="modal-subtitle"
              >
                {{ subtitle }}
              </h3>
              <div class="mt-5">
                <p class="text-sm text-gray-500">
                  {{ content }}
                </p>
              </div>
            </div>
          </div>
          <div class="my-10">
            <div class="overflow-hidden bg-white shadow sm:rounded-lg">
              <div class="border-t border-gray-200">
                <dl>
                  <div
                    class="bg-gray-100 px-4 py-5 flex items-center justify-between sm:px-6"
                  >
                    <dt class="text-sm font-medium text-gray-500">
                      Temperature
                    </dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0">
                      {{ userInfo.weather.temperature }}°F
                    </dd>
                  </div>
                  <div
                    class="bg-white px-4 py-5 flex items-center justify-between sm:px-6"
                  >
                    <dt class="text-sm font-medium text-gray-500">Pressure</dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0">
                      {{ userInfo.weather.pressure }} hPa
                    </dd>
                  </div>
                  <div
                    class="bg-gray-100 px-4 py-5 flex items-center justify-between sm:px-6"
                  >
                    <dt class="text-sm font-medium text-gray-500">Humidity</dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0">
                      {{ userInfo.weather.humidity }}%
                    </dd>
                  </div>
                  <div
                    class="bg-white px-4 py-5 flex items-center justify-between sm:px-6"
                  >
                    <dt class="text-sm font-medium text-gray-500">
                      Wind Speed
                    </dt>
                    <dd class="mt-1 text-sm font-bold text-gray-900 sm:mt-0">
                      {{ userInfo.weather.wind_speed }} miles/hour
                    </dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-6">
            <button
              type="button"
              class="inline-flex w-full justify-center rounded-md bg-violet-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              @click="$emit('close')"
            >
              Close Report
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { storeToRefs } from "pinia";
import { useUserStore } from "@/stores/useUserStore";

interface Props {
  show: boolean;
  title: string;
  subtitle: string;
  content: string;
}

defineProps<Props>();

defineEmits(["close"]);

const userStore = useUserStore();
const { userInfo } = storeToRefs(userStore);
</script>
