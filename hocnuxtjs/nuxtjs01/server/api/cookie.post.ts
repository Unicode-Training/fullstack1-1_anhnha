
export default defineEventHandler(async (event) => {
    const { key, value } = await readBody(event);
    setCookie(event, key, value, {
        httpOnly: true,
    })
    return {
        success: true
    }
})
