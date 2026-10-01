export const CACHE_KEYS = {
    PRODUCT: {
        LIST: `product-list`,
        DETAIL: (id: string) => `product-detail:${id}`
    }
}