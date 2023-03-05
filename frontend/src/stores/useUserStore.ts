import { defineStore } from "pinia";
import { useFetch } from "@/composables/useFetch";

type WeatherInfo = {
  main: string;
  description: string;
};

type User = {
  id: number;
  name: string;
  email: string;
  weather: WeatherInfo;
};

type UserResult = {
  message: string;
  users: Array<User>;
};

export const useUserStore = defineStore("users", {
  state: () => {
    return {
      loading: false as boolean,
      users: [] as User[],
    };
  },

  actions: {
    async loadUsers() {
      this.loading = true;

      const { data } = await useFetch<UserResult>("/users");

      this.users = (data.value as UserResult)?.users;

      this.loading = false;
    },
  },
});
