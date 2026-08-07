export default {
    actions: {
        async returnOurProjectsIndex(ctx, data) {
            return await Vue.axios.post('/our-projects', data)
                .then(response => {
                    return response.data;
                });
        },
        async returnOurProjectsGet(ctx, data) {
            return await Vue.axios.post('/our-projects-edit', data)
                .then(response => {
                    return response.data;
                });
        },
    }
}
