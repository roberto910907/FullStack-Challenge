import { useFetch as baseFetch } from "@vueuse/core";
import type { UseFetchOptions, UseFetchReturn } from "@vueuse/core";

export const useFetch = async <T>(
  url: string,
  options = {} as UseFetchOptions
): Promise<UseFetchReturn<T>> => {
  const apiUrl: string = import.meta.env.VITE_API_URL;

  return baseFetch(`${apiUrl}/${url}`, options).get().json();
};
