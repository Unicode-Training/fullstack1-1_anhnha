export const getProductList = async () => {
    const response = await $fetch<{
        data: {
            data: { id: number; name: string; price: number }[]
        }
    }>(`http://127.0.0.1:8000/api/products`);
    if (!response) {
        return;
    }
    return response.data.data;
}

export const getProduct = async (id: string) => {
    const response = await $fetch<{
        data: { id: number; name: string; price: number; description: string }
    }>(`http://127.0.0.1:8000/api/products/${id}`);
    if (!response) {
        return;
    }
    return response.data;
}

export const createProduct = async (body: { name: string; price: number; description: string }) => {
    const response = await $fetch(`http://127.0.0.1:8000/api/products`, {
        method: 'POST',
        body
    });
    return response;
}

export const updateProduct = async (body: { name: string; price: number; description: string }, id: string) => {
    const response = await $fetch(`http://127.0.0.1:8000/api/products/${id}`, {
        method: 'PATCH',
        body
    });
    return response;
}