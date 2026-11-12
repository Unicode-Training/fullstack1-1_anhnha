export default defineEventHandler((event) => {
    console.log('New request:', event.node.req.url);
    event.context.auth = { user: 'guest' }
})