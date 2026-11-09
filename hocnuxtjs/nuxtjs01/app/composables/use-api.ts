import { getAccessToken, getRefreshToken, saveToken } from "~~/utils/utils";

export const useApi = async <T>(url: string,) => {
    const config = useRuntimeConfig();
    const reqHeaders = useRequestHeaders(["cookie"]);
    const resHeaders = useResponseHeader('x-accessToken');

    const query = await useFetch<T>(
        `${config.public.laravelServer}${url}`,
        {

            async onRequest({ request, options }) {
                const accessToken = await getAccessToken(reqHeaders);

                if (accessToken) {
                    const headers = new Headers(options.headers || {});
                    headers.set("Authorization", `Bearer ${resHeaders.value ?? accessToken}`);
                    options.headers = headers;
                }
            },
            async onResponseError({ request, response, options }) {
                if (response.status === 401 && !resHeaders.value) {
                    const refreshToken = await getRefreshToken(reqHeaders);
                    try {
                        const newToken = await $fetch<{
                            data: { accessToken: string; refreshToken: string };
                        }>(`${config.public.laravelServer}/auth/refresh-token`, {
                            method: "POST",
                            body: { refreshToken },
                        });

                        await saveToken(newToken.data);

                        await query.refresh();
                    } catch (error) {
                        console.log(error);
                    }
                }
            },
        },
    );

    return query;
}