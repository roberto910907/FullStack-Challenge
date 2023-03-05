<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header class="bg-gray-900 text-white">
    <div class="wrapper flex h-14">
      <nav class="font-bold text-lg pl-5 my-auto">
        <RouterLink to="/">Weather Forecast Application</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />
</template>
