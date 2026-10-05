export const debounce = <T>(callback: (...args: T[]) => void, timeout = 500) => {
    let timeoutId: NodeJS.Timeout;
    return (...args: T[]) => {
        if (timeoutId) {
            clearTimeout(timeoutId);
        }
        timeoutId = setTimeout(() => {
            callback(...args);
        }, timeout)
    }
}

export const saveToken = async (token: { accessToken: string; refreshToken: string }, headers?: { cookie?: string } | undefined) => {
    await Promise.all([
        $fetch(`/api/cookie`, {
            method: 'post',
            body: {
                key: 'accessToken',
                value: token.accessToken
            },
            ...(headers ? { headers } : {})
        }),
        $fetch(`/api/cookie`, {
            method: 'post',
            body: {
                key: 'refreshToken',
                value: token.refreshToken
            },
            ...(headers ? { headers } : {})
        })
    ])
}

export const getAccessToken = async (headers: { cookie?: string }) => {

    const { data } = await $fetch(`/api/cookie?key=accessToken`, { headers });
    return data;
}

export const getRefreshToken = async (headers: { cookie?: string }) => {
    const { data } = await $fetch(`/api/cookie?key=refreshToken`, { headers });
    return data;
}


//client -> nuxt -> backend