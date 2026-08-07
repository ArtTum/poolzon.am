export default {
    actions: {
        async returnSlidersIndex(ctx) {
            Vue.axios.post('/sliders', this.state.returnSliders.data).then((response) => {
                const returnSlidersIndex = response.data;
                ctx.commit('updateSlidersIndex', returnSlidersIndex);
            });
        },
        async returnSlidersGet(ctx) {
            Vue.axios.post('/sliders-edit', {
                id: this.state.returnSliders.id
            }).then((response) => {
                const returnSlidersGet = response.data;
                ctx.commit('updateSlidersGet', returnSlidersGet);
            });
        },
        async changeSliderStatus(ctx) {
            Vue.axios.post('/change-slider-status', {
                id: this.state.returnSliders.id,
            }).then((response) => {
                const returnSlidersGet = response.data;
                ctx.commit('updateSlidersGet', returnSlidersGet);
            });
        },
    },
    mutations: {
        updateSlidersIndex(state, returnSlidersIndex) {
            state.returnSlidersIndex = returnSlidersIndex
        },
        changeSlidersStates(state, data) {
            state.data = data;
        },
        updateSlidersGet(state, returnSlidersGet) {
            state.returnSlidersGet = returnSlidersGet
        },
        changeSlidersGet(state, id) {
            state.id = id;
        },
    },
    state: {
        returnSlidersIndex: [],
        returnSlidersGet: [],
        data: null,
        id: null,
    },
    getters: {
        allReturnSlidersIndex(state) {
            return state.returnSlidersIndex
        },
        allReturnSlidersGet(state) {
            return state.returnSlidersGet
        },
    },
}
