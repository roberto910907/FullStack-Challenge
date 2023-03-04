import { defineStore } from "pinia";
import { useFetch } from "@/composables/useFetch";

type User = {
  id: number;
  email: string;
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

      const { data } = await useFetch<UserResult>("/");

      this.users = (data.value as UserResult)?.users;

      this.loading = false;
    },
  },
});
