export default {
    actions: {
        async returnBrandsIndex(ctx) {
            Vue.axios.post('/brands', this.state.returnBrands.data).then((response) => {
                const returnBrandsIndex = response.data;
                ctx.commit('updateBrandsIndex', returnBrandsIndex);
            });
        },
        async returnBrandGet(ctx) {
            Vue.axios.post('/brand-edit', {
                id: this.state.returnBrands.id
            }).then((response) => {
                const returnBrandGet = response.data;
                ctx.commit('updateBrandGet', returnBrandGet);
            });
        },
        async changeBrandStatus() {
            Vue.axios.post('/change-brand-status', {
                id: this.state.returnBrands.id
            }).then((response) => {
              return true;
            });
        },
        async returnBrandSort(ctx, data) {
            Vue.axios.post('/brands-sort', {sort: data}).then((response) => {
                console.log(response)
            });
        },
    },
    mutations: {
        updateBrandsIndex(state, returnBrandsIndex) {
            state.returnBrandsIndex = returnBrandsIndex
        },
        changeBrands(state, data) {
            state.data = data;
        },
        updateBrandGet(state, returnBrandGet) {
            state.returnBrandGet = returnBrandGet
        },
        changeBrandsGet(state, dataSort) {
            state.dataSort = dataSort;
        },
        changeBrandId(state, id) {
            state.id = id;
        }
    },
    state: {
        returnBrandsIndex: [],
        returnBrandGet: [],
        data: '',
        id: null
    },
    getters: {
        allReturnBrandsIndex(state) {
            return state.returnBrandsIndex
        },
        returnBrandGet(state) {
            return state.returnBrandGet
        }
    },
}
