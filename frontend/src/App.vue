<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header class="bg-gray-900 text-white">
    <div class="wrapper flex justify-between h-14">
      <nav class="font-bold text-base sm:text-lg pl-5 my-auto">
        <RouterLink to="/">Weather Forecast Application</RouterLink>
      </nav>

      <div class="flex w-1/2 sm:w-auto sm:mr-5">
        <span class="my-auto relative flex h-3 w-3">
          <span
            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"
          ></span>
          <span
            class="relative inline-flex rounded-full h-3 w-3 bg-green-500"
          ></span>
        </span>
        <span class="my-auto ml-2 text-sm sm:text-base">Real-time updates</span>
      </div>
    </div>
  </header>

  <RouterView />
</template>
