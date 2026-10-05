import { getAccessToken, getRefreshToken, saveToken } from "~~/utils/utils";

export const useApi = async () => {
    const config = useRuntimeConfig();
    const reqHeaders = useRequestHeaders(["cookie"]);
    const { data: user } = await useFetch<{ name: string }>(
        `${config.public.laravelServer}/auth/profile`,
        {
            server: false,
            async onRequest({ request, options }) {
                const accessToken = await getAccessToken(reqHeaders);
                if (accessToken) {
                    const headers = new Headers(options.headers || {});
                    headers.set("Authorization", `Bearer ${accessToken}`);
                    options.headers = headers;
                }
            },
            async onResponseError({ request, response, options }) {
                if (response.status === 401) {
                    const refreshToken = await getRefreshToken(reqHeaders);
                    try {
                        const newToken = await $fetch<{
                            data: { accessToken: string; refreshToken: string };
                        }>(`${config.public.laravelServer}/auth/refresh-token`, {
                            method: "POST",
                            body: { refreshToken },
                        });

                        if (import.meta.server) {

                            return;
                        }

                        await saveToken(newToken.data);
                    } catch (error) {
                        console.log(error);
                    }
                }
            },
        },
    )

    return { user }
}