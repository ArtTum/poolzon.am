export default {
    actions: {
        async returnProductsIndex(ctx) {
            Vue.axios.post('/products', this.state.returnProducts.data).then((response) => {
                const returnProductsIndex = response.data;
                ctx.commit('updateProductsIndex', returnProductsIndex);
            });
        },
        async returnProductsGet(ctx) {
            Vue.axios.post('/products-edit/'+this.state.returnProducts.id).then((response) => {
                const returnProductsGet = response.data;
                ctx.commit('updateProductsGet', returnProductsGet);
            });
        },
        async returnProductsParam(ctx) {
            Vue.axios.post('/products-param', this.state.returnProducts.data).then((response) => {
                const returnProductsParam = response.data;
                ctx.commit('updateProductsParam', returnProductsParam);
            });
        },
    },
    mutations: {
        updateProductsIndex(state, returnProductsIndex) {
            state.returnProductsIndex = returnProductsIndex
        },
        changeProducts(state, data){
            state.data = data;
        },
        updateProductsGet(state, returnProductsGet) {
            state.returnProductsGet = returnProductsGet
        },
        changeProductsGet(state, id){
           state.id = id;
        },
        updateProductsParam(state, returnProductsParam) {
            state.returnProductsParam = returnProductsParam
        },
        changeProductsParam(state, returnProductsParam){
            state.returnProductsParam = returnProductsParam;
        },

    },
    state: {
        returnProductsIndex: [],
        returnProductsGet: [],
        returnProductsParam: [],
        data: '',
        id: '',
    },
    getters: {
        allReturnProductsIndex(state) {
            return state.returnProductsIndex
        },
        allReturnProductsParam(state) {
            return state.returnProductsParam
        },
        allReturnProductsGet(state) {
            return state.returnProductsGet
        },
    },
}
