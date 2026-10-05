export const useScroll = () => {
    const value = ref(0);
    onMounted(() => {
        const handleScroll = () => {
            const y = window.scrollY;
            value.value = y;
        };
        document.addEventListener("scroll", handleScroll);
    });
    return value;
}