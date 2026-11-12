export default defineEventHandler((event) => {
    return {
        hello: 'world',
        data: helloWorld('abc'),
    }
})