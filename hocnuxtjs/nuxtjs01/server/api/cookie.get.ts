export default defineEventHandler(async (event) => {
    const query = getQuery(event);
    const key = query.key;
    const value = getCookie(event, key as string)
    return {
        success: true,
        data: value
    }
})
