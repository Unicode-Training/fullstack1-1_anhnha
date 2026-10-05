export const useFetch2 = (url: string) => {
    const data = ref([]);
    const error = ref(null);
    const loading = ref(true);

    const requestData = async () => {
        console.log('requestData');

        try {
            const response = await fetch(url);
            const apiData = await response.json();
            data.value = apiData;
        } catch (error) {
            console.log(error);

            error.value = error;
        } finally {
            loading.value = false;
        }
    }

    onMounted(requestData);

    return {
        data,
        error,
        loading
    }
}