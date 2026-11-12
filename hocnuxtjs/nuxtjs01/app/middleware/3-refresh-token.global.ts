import { getAccessToken, getRefreshToken } from "~~/utils/utils";

export default defineNuxtRouteMiddleware(async (to, from) => {
    console.log('refresh token');
    const user = useState('auth-user', () => null)
    if (import.meta.server) {
        const event = useRequestEvent();
        user.value = event?.context.auth.user;
        const config = useRuntimeConfig();
        const reqHeaders = useRequestHeaders(["cookie"]);
        const accessToken = await getAccessToken(reqHeaders);
        const refreshToken = await getRefreshToken(reqHeaders);
        try {
            await $fetch(`${config.public.laravelServer}/auth/profile`, {
                headers: {
                    Authorization: `Bearer ${accessToken}`
                }
            });
        } catch {
            //Refresh token
            try {
                const { data: newToken } = await $fetch<{
                    data: { accessToken: string; refreshToken: string };
                }>(`${config.public.laravelServer}/auth/refresh-token`, {
                    method: "POST",
                    body: { refreshToken },
                });


                const accessTokenCookie = useCookie('accessToken', {
                    httpOnly: true
                });

                accessTokenCookie.value = newToken.accessToken;

                const accessTokenHeader = useResponseHeader('x-accessToken');
                accessTokenHeader.value = newToken.accessToken;

                const refreshTokenCookie = useCookie('refreshToken', {
                    httpOnly: true
                });
                refreshTokenCookie.value = newToken.refreshToken;

            } catch {

            }

        }

    }

    console.log(user.value);
})  