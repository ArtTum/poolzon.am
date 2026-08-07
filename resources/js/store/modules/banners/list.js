export default {
    actions: {
        async returnBannersIndex(ctx) {
            Vue.axios.post('/banners', this.state.returnBanners.data).then((response) => {
                const returnBannersIndex = response.data;
                ctx.commit('updateBannersIndex', returnBannersIndex);
            });
        },
        async returnBannersGet(ctx) {
            Vue.axios.post('/banners-edit', {
                id: this.state.returnBanners.id
            }).then((response) => {
                const returnBannersGet = response.data;
                ctx.commit('updateBannersGet', returnBannersGet);
            });
        },
        async changeBannerStatus(ctx) {
            Vue.axios.post('/change-banner-status', {
                id: this.state.returnBanners.id,
            }).then((response) => {
                const returnBannersGet = response.data;
                ctx.commit('updateBannersGet', returnBannersGet);
            });
        },
    },
    mutations: {
        updateBannersIndex(state, returnBannersIndex) {
            state.returnBannersIndex = returnBannersIndex
        },
        changeBannersStates(state, data) {
            state.data = data;
        },
        updateBannersGet(state, returnBannersGet) {
            state.returnBannersGet = returnBannersGet
        },
        changeBannersGet(state, id) {
            state.id = id;
        },
    },
    state: {
        returnBannersIndex: [],
        returnBannersGet: [],
        data: null,
        id: null,
    },
    getters: {
        allReturnBannersIndex(state) {
            return state.returnBannersIndex
        },
        allReturnBannersGet(state) {
            return state.returnBannersGet
        },
    },
}
