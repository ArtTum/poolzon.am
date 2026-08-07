export default {
    actions: {
        async returnOrdersIndex(ctx) {
            Vue.axios.post('/orders', this.state.returnOrders.data).then((response) => {
                const returnOrdersIndex = response.data;
                ctx.commit('updateOrdersIndex', returnOrdersIndex);
            });
        },
        async returnOrdersGet(ctx) {
            Vue.axios.post('/orders-view', {
                id: this.state.returnOrders.id
            }).then((response) => {
                const returnOrdersGet = response.data;
                ctx.commit('updateOrdersGet', returnOrdersGet);
            });
        },
    },
    mutations: {
        updateOrdersIndex(state, returnOrdersIndex) {
            state.returnOrdersIndex = returnOrdersIndex
        },
        changeOrdersStates(state, data) {
            state.data = data;
        },
        updateOrdersGet(state, returnOrdersGet) {
            state.returnOrdersGet = returnOrdersGet
        },
        changeOrdersGet(state, id) {
            state.id = id;
        },
    },
    state: {
        returnOrdersIndex: [],
        returnOrdersGet: [],
        data: null,
        id: null,
    },
    getters: {
        allReturnOrdersIndex(state) {
            return state.returnOrdersIndex
        },
        allReturnOrdersGet(state) {
            return state.returnOrdersGet
        },
    },
}
